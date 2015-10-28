<?php

namespace Vinfo\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder as QueryBuilder;

use Dimsav\Translatable\Translatable;

use Pinyin;

trait TranslatableSortable
{
	
	use Translatable;
	
  public function getNameEnAttribute()
  {
    return $this->translate('en')->name;
    // return $this->translate('en')->name !== $this->name ? $this->translate('en')->name : null;
  }

  public function scopeWithTranslations(Builder $query)
  {

    $withFallback = $this->useFallback();

    $translatedAttributes = $this->translatedAttributes;
    $translatedAttributes = array_map(function($attribute) {
      return $this->getTranslationsTable().'.'.$attribute;
    }, $translatedAttributes);
    $translatedAttributes = array_merge([$this->getTable().'.*'], $translatedAttributes);

    $query
    ->select($translatedAttributes)
    ->leftJoin($this->getTranslationsTable(), $this->getTranslationsTable().'.'.$this->getRelationKey(), '=', $this->getTable().'.'.$this->getKeyName())
    ->where(function ($query) use ($withFallback) {

      $query->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->Locale());

      if ($withFallback) {
        $query->orWhere(function (Builder $q) {
          $q->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->getFallbackLocale($this->Locale()))
          ->whereNotIn($this->getTranslationsTable().'.'.$this->getRelationKey(), function (QueryBuilder $q) {
            $q->select($this->getTranslationsTable().'.'.$this->getRelationKey())
            ->from($this->getTranslationsTable())
            ->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->Locale());
          });
        })->orWhere(function (Builder $q) {
          $q->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->getFallbackLocale())
          ->whereNotIn($this->getTranslationsTable().'.'.$this->getRelationKey(), function (QueryBuilder $q) {
            $q->select($this->getTranslationsTable().'.'.$this->getRelationKey())
            ->from($this->getTranslationsTable())
            ->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->getFallbackLocale($this->Locale()))
            ->orWhere($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->Locale());
          });
        });
      }
    });

}

public function scopeWithRelatedTranslations(Builder $query, $relation)
{
  $model = $relation->getRelated();
  $withFallback = $model->usePublicFallback();

  $translatedAttributes = $model->translatedAttributes;
  $translatedAttributes = array_map(function($attribute) use ($model) {
    return $model->getPublicTranslationsTable().'.'.$attribute . ' AS ' . $model->getPublicTranslationsTable().'_'.$attribute;
  }, $translatedAttributes);
  
  $query->withTranslations();

  $translatedAttributes = array_merge((array) $query->getQuery()->columns, $translatedAttributes);
  
  $query->select($translatedAttributes)
  ->leftJoin($model->getPublicTranslationsTable(), $model->getPublicTranslationsTable().'.'.$model->getRelationKey(), '=', $relation->getQualifiedForeignKey())
  ->where(function ($query) use ($model, $withFallback) {

    $query->where($model->getPublicTranslationsTable().'.'.$model->getLocaleKey(), $model->publicLocale());

    if ($withFallback) {
      $query->orWhere(function (Builder $q) use ($model) {
        $q->where($model->getPublicTranslationsTable().'.'.$model->getLocaleKey(), $model->getPublicFallbackLocale($model->publicLocale()))
        ->whereNotIn($model->getPublicTranslationsTable().'.'.$model->getRelationKey(), function (QueryBuilder $q) use ($model) {
          $q->select($model->getPublicTranslationsTable().'.'.$model->getRelationKey())
          ->from($model->getPublicTranslationsTable())
          ->where($model->getPublicTranslationsTable().'.'.$model->getLocaleKey(), $model->publicLocale());
        });
      })->orWhere(function (Builder $q) use ($model) {
        $q->where($model->getPublicTranslationsTable().'.'.$model->getLocaleKey(), $model->getPublicFallbackLocale())
        ->whereNotIn($model->getPublicTranslationsTable().'.'.$model->getRelationKey(), function (QueryBuilder $q) use ($model) {
          $q->select($model->getPublicTranslationsTable().'.'.$model->getRelationKey())
          ->from($model->getPublicTranslationsTable())
          ->where($model->getPublicTranslationsTable().'.'.$model->getLocaleKey(), $model->getPublicFallbackLocale($model->publicLocale()))
          ->orWhere($model->getPublicTranslationsTable().'.'.$model->getLocaleKey(), $model->publicLocale());
        });
      });
    }
  });

}

    /**
     * This scope eager loads the translations for the default and the fallback locale only.
     * We can use this as a shortcut to improve performance in our application.
     *
     * @param Builder $query
     */
    public function scopeWithTranslation(Builder $query)
    {
      $query->with(['translations' => function($query){
       $query->where(function($query) {
        $query->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->locale());
        if ($this->useFallback()) {
         return $query->orWhere($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->getFallbackLocale($this->locale()))
         ->orWhere($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->getFallbackLocale());
       }
     });
     }]);
    }

    public function scopeOrderByTranslation(Builder $query, $field, $direction = 'asc')
    {	
      $field = $this->getTranslationsTable().'.'.$field;
      return $query->withTranslations()->orderBy($field, $direction);
    }

    public function scopeOrderByRelationTranslation(Builder $query, $relation, $field, $direction = 'asc')
    {	
      $relation = $this->$relation();
      $related = $relation->getRelated();

      $field = $related->getPublicTranslationsTable().'_'.$field;
      return $query->withRelatedTranslations($relation)->orderBy($field, $direction);

      // $relationQuery = $related->orderByTranslation($field, $direction)->getQuery();

      // dd($relation);
      // dd($relationQuery);

      // foreach ($relationQuery->orders as $order) {
      //   $query->orderBy($order['column'], $order['direction']);
      // }

      // dd($related->getTranslationsTable());

      // $query->leftJoin();

      // dd($query->leftJoin($relation->getParent()->getTable(), $relation->getQualifiedOtherKeyName(), '=', $relation->getQualifiedForeignKey())->toSql());

      return $query;
    }

	    /**
     * @param string|null $locale
     * @param bool        $withFallback
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
      public function getTranslation($locale = null, $withFallback = null)
      {
        $locale = $locale ?: $this->locale();
        $withFallback = $withFallback === null ? $this->useFallback() : $withFallback;
        $fallbackLocale = $this->getFallbackLocale($locale);
        $finalFallbackLocale = $this->getFallbackLocale();
        if ($this->getTranslationByLocaleKey($locale)) {
          $translation = $this->getTranslationByLocaleKey($locale);
        } elseif ($withFallback
          && $fallbackLocale
          && $this->getTranslationByLocaleKey($fallbackLocale)
          ) {
          $translation = $this->getTranslationByLocaleKey($fallbackLocale);
        } elseif ($withFallback
          && $fallbackLocale
          && $this->getTranslationByLocaleKey($finalFallbackLocale)
          ) {
          $translation = $this->getTranslationByLocaleKey($finalFallbackLocale);
        } else {
          $translation = null;
        }
        return $translation;
      }

      public function scopeWhereTranslationIn($query, $key, $value, $locale = null)
      {
        return $query->whereHas('translations', function ($query) use ($key, $value, $locale) {
          $query->whereIn($this->getTranslationsTable().'.'.$key, $value);
          if ($locale) {
            $query->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $locale);
          }
        });
      }

      public function scopeWhereTranslationLike($query, $key, $value, $locale = null)
      {
        return $query->whereHas('translations', function ($query) use ($key, $value, $locale) {
          $query->where($this->getTranslationsTable().'.'.$key, 'LIKE', $value);
          if ($locale) {
            $query->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $locale);
          }
        });
      }

	    /**
     * @param string $key
     * @param mixed  $value
     */
  //   public function setAttribute($key, $value)
  //   {
  //       if (str_contains($key, ':')) {
  //           list($key, $locale) = explode(':', $key);
  //       } else {
  //           $locale = $this->locale();
  //       }

		// if (in_array($key, $this->translatedAttributes)) {
  //           $this->getTranslationOrNew($locale)->$key = $value;
  //       } else {
  //           parent::setAttribute($key, $value);
  //       }
		// if (in_array($locale, ['zh', 'zh-Hans', 'zh-Hant'])) {
		// 	$locale = 'zh-Latn-pinyin';
		// 	if (in_array($key, $this->translatedAttributes)) {
		// 		$value = Pinyin::trans($value);
		// 		$this->getTranslationOrNew($locale)->$key = $value;
		// 	}
		// }
  //   }
    }