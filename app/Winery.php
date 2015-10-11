<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Winery extends Model
{
    use SoftDeletes;

    protected $fillable = [
	    'name',
	    'address',
    ];

	public function country()
	{
		return $this->belongsTo('Vinfo\Country');
	}
}
