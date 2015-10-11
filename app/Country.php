<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Vinfo\Traits\TranslatableSortable;

class Country extends Model
{
    use SoftDeletes;
    use Translatable;
    use TranslatableSortable;

    protected $fillable = [
	    'name',
	    'code',
    ];

    public $translatedAttributes = ['name'];
}
