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
	
	public function scopeOrderByActive($query, $direction = 'asc')
	{
		return $query->orderBy(DB::raw('CHAR_LENGTH(`countries`.`code`)=2'), $direction);
	}
	
	public function scopewhereActive($query)
	{
		return $query->whereRaw('CHAR_LENGTH(`countries`.`code`)=2');
	}
}
