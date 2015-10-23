<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/* use Dimsav\Translatable\Translatable; */
use Vinfo\Traits\TranslatableSortable;
use Punic\Unit;
use App;

class BottleSize extends Model
{
    use SoftDeletes;
/*     use Translatable; */
    use TranslatableSortable;

    protected $fillable = [
        'name',
        'capacity',
        'is_common',
    ];

    public $translatedAttributes = ['name'];

    public function bottles()
    {
    	return $this->hasMany('Vinfo\Bottles');
    }

    public function getCapacityFormattedAttribute()
    {
		$capacity = $this->getAttributeFromArray('capacity');

        if ($capacity < 1) {
            $capacity = $capacity * 1000;
            $symbol = 'milliliter';
        }
        else {
            $symbol = 'liter';
        }

        $length = $capacity - (int) $capacity;
        $length = strlen(ltrim($length, '.0'));

        $capacity = Unit::format($capacity, $symbol, $length, App::getLocale());

        return $capacity;
    }
}
