<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/* use Dimsav\Translatable\Translatable; */
use Vinfo\Traits\TranslatableSortable;
use DB;

class Country extends Model
{
    use SoftDeletes;
/*     use Translatable; */
    use TranslatableSortable;

    protected $fillable = [
	    'name',
	    'code',
    ];
	
 	public $with = [
		'translations'
	];

    public $translatedAttributes = ['name'];
	
	public function getIsActiveAttribute()
	{
		return strlen($this->code) == 2;
	}
	
	public function scopeOrderByIsActive($query, $direction = 'asc')
	{
		return $query->orderBy(DB::raw('CHAR_LENGTH(`countries`.`code`)=2'), $direction);
	}
	
	public function scopeWhereIsActive($query)
	{
		return $query->whereRaw('CHAR_LENGTH(`countries`.`code`)=2');
	}
	
	public function scopeWhereIsWine($query)
	{
		return $query->where('is_wine', true);
	}

	public function geometries()
	{
		return $this->morphMany('Vinfo\Geometry', 'geometried');
	}

	public function getPublicTranslationsTable()
	{
		return $this->getTranslationsTable();
	}

	public function usePublicFallback()
	{
		return $this->useFallback();
	}

	public function publicLocale()
	{
		return $this->locale();
	}

	public function getPublicFallbackLocale($locale = null)
	{
		return $this->getFallbackLocale($locale);
	}
}
