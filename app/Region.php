<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;

    protected $fillable = [
	    'name',
	    'description',
	    'is_structural',
    ];

    public function type()
    {
    	return $this->belongsTo('Vinfo\PriceType');
    }

}
