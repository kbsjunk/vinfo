<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Vinfo\Traits\TranslatableSortable;

class RegionType extends Model
{
    use SoftDeletes;
    use Translatable;
    use TranslatableSortable;

    protected $fillable = [
        'name',
        'description',
    ];

    public $fieldTypes = [
    	'description' => 'textarea'
    ];

    public $translatedAttributes = ['name', 'description'];

}
