<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

use SebastianBergmann\Money\Currency as MoneyCurrency;
use SebastianBergmann\Money\Money as Money;

class Price extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'price',
		'currency_code',
	];

	protected $dates = [
		'created_at',
		'updated_at',
		'deleted_at',
		'priced_at',
		'converted_at',
	];

	public function priceable()
    {
        return $this->morphTo();
    }

    public function getMoneyAttribute()
    {
    	return new Money($this->getAttributeFromArray('price'), new MoneyCurrency($this->getAttributeFromArray('currency')));
    }

    public function getMoneyLocalAttribute()
    {
    	return new Money($this->getAttribute('price_local'), new MoneyCurrency($this->getAttributeFromArray('currency')));
    }

    public function type()
    {
    	return $this->belongsTo('Vinfo\PriceType');
    }

    public function getCurrencyCodeAttribute($currency_code)
    {
        return $currency_code ?: 'USD';
    }

    public function currency()
    {
    	return $this->belongsTo('Vinfo\Currency', 'currency_code');
    }

}
