<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsumedReason extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
	    'name',
	    'is_drank',
	    'info',
    ];

    public function bottles()
    {
    	return $this->hasMany('Vinfo\Bottles');
    }

    protected $casts = [
    	'info' => 'json',
    ];

}
