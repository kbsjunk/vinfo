<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wine extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
    	'name',
    	'nickname',
    	'description',
    ];

    public function vintages()
    {
    	return $this->hasMany('Vinfo\Vintage');
    }

	public function winery()
	{
		return $this->belongsTo('Vinfo\Winery');
	}

	public function region()
	{
		return $this->belongsTo('Vinfo\Region');
	}

    
}
