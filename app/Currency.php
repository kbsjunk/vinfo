<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Vinfo\Traits\TranslatableSortable;
use SebastianBergmann\Money\Currency as MoneyCurrency;

class Currency extends Model
{
	use SoftDeletes;
    use Translatable;
    use TranslatableSortable;
	
	protected $fillable = [
		'code',
		'name',
	];

    public $translatedAttributes = ['name'];

    public function getCurrencyAttribute()
    {
    	return new MoneyCurrency($this->getAttributeFromArray('currency'));
    }

    public function getNameEnAttribute()
    {
    	return $this->translate('en')->name;
    }

}
