<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class RegionTranslation extends Model {

    protected $fillable = ['name', 'description'];

    public function region()
    {
    	return $this->belongsTo('Vinfo\Region');
    }

}