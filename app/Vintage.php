<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vintage extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'year',
        'wine_id',
    ];

    public function wine()
    {
    	return $this->belongsTo('Vinfo\Wine');
    }

	public function getNameAttribute()
	{
		return $this->year . ' ' . $this->wine->name;
	}
}
