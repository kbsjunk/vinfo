<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class CountryTranslation extends Model {

    protected $fillable = ['name'];

    public function country()
    {
    	return $this->belongsTo('Vinfo\Country');
    }

}