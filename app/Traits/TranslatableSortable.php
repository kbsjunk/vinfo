<?php

namespace Vinfo\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait TranslatableSortable
{
    public function getNameEnAttribute()
    {
        return $this->translate('en')->name;
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
            ->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->locale())
        ;
        if ($withFallback) {
            $query->orWhere(function (Builder $q) {
                $q->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->getFallbackLocale())
                    ->whereNotIn($this->getTranslationsTable().'.'.$this->getRelationKey(), function (QueryBuilder $q) {
                        $q->select($this->getTranslationsTable().'.'.$this->getRelationKey())
                            ->from($this->getTranslationsTable())
                            ->where($this->getTranslationsTable().'.'.$this->getLocaleKey(), $this->locale());
                    });
            });
        }
    }

    public function scopeOrderByTranslation(Builder $query, $field, $direction = 'asc')
    {
    	return $query->withTranslations()->orderBy($this->getTranslationsTable().'.'.$field, $direction);
    }
}