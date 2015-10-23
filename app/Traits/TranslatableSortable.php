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
    }

    public function scopeWithTranslations(Builder $query, $model = false)
    {
		$model = $model ?: $this;
        $withFallback = $model->useFallback();

        $translatedAttributes = $model->translatedAttributes;
        $translatedAttributes = array_map(function($attribute) use ($model) {
            return $model->getTranslationsTable().'.'.$attribute;
        }, $translatedAttributes);
        $translatedAttributes = array_merge([$model->getTable().'.*'], $translatedAttributes);

		$query
			->select($translatedAttributes)
			->leftJoin($model->getTranslationsTable(), $model->getTranslationsTable().'.'.$model->getRelationKey(), '=', $model->getTable().'.'.$model->getKeyName())
			->where(function ($query) use ($model, $withFallback) {

				$query->where($model->getTranslationsTable().'.'.$model->getLocaleKey(), $model->locale());

				if ($withFallback) {
					$query->orWhere(function (Builder $q) use ($model) {
						$q->where($model->getTranslationsTable().'.'.$model->getLocaleKey(), $model->getFallbackLocale($model->locale()))
							->whereNotIn($model->getTranslationsTable().'.'.$model->getRelationKey(), function (QueryBuilder $q) use ($model) {
								$q->select($model->getTranslationsTable().'.'.$model->getRelationKey())
									->from($model->getTranslationsTable())
									->where($model->getTranslationsTable().'.'.$model->getLocaleKey(), $model->locale());
							});
					})->orWhere(function (Builder $q) use ($model) {
						$q->where($model->getTranslationsTable().'.'.$model->getLocaleKey(), $model->getFallbackLocale())
							->whereNotIn($model->getTranslationsTable().'.'.$model->getRelationKey(), function (QueryBuilder $q) use ($model) {
								$q->select($model->getTranslationsTable().'.'.$model->getRelationKey())
									->from($model->getTranslationsTable())
									->where($model->getTranslationsTable().'.'.$model->getLocaleKey(), $model->getFallbackLocale($model->locale()))
									->orWhere($model->getTranslationsTable().'.'.$model->getLocaleKey(), $model->locale());
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
		$relation = $this->$relation()->getRelated()->first();
		
/* 		$rf = new \ReflectionClass($relation); */
/* 		dd($rf->getMethods()); */
		
  		dd($relation);
		$field = $relation->getTranslationsTable().'.'.$field;
    	return $query->withTranslations($relation)->orderBy($field, $direction);
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
	
	    /**
     * @param string $key
     * @param mixed  $value
     */
    public function setAttribute($key, $value)
    {
        if (str_contains($key, ':')) {
            list($key, $locale) = explode(':', $key);
        } else {
            $locale = $this->locale();
        }
		
		if (in_array($key, $this->translatedAttributes)) {
            $this->getTranslationOrNew($locale)->$key = $value;
        } else {
            parent::setAttribute($key, $value);
        }
		if (in_array($locale, ['zh', 'zh-Hans', 'zh-Hant'])) {
			$locale = 'zh-Latn-pinyin';
			if (in_array($key, $this->translatedAttributes)) {
				$value = Pinyin::trans($value);
				$this->getTranslationOrNew($locale)->$key = $value;
			}
		}
    }
}