<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Punic\Language as PunicLanguage;
use App;

class Language extends Model
{
	protected $fillable = [
		'code',
		'name',
	];

    public function getNameLocalAttribute()
    {
    	return PunicLanguage::getName($this->code, App::getLocale());
    }
}
