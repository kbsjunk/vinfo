<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegionType extends Model
{
    use SoftDeletes;

    protected $fillable = [
	    'name',
	    'description',
    ];
}
