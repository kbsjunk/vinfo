<?php

namespace Vinfo;

use Baum\Node;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/* use Dimsav\Translatable\Translatable; */
use Vinfo\Traits\TranslatableSortable;
use Vinfo\Transformers\RegionTransformer;

class Region extends Node {

	use SoftDeletes;
/* 	use Translatable; */
	use TranslatableSortable;

	protected $fillable = [
		'name',
		'description',
		'is_structural',
	];

	public $fieldTypes = [
		'description' => 'textarea'
	];

	public $with = [
		'translations',
		'native_names_translations',
	];

	/**
	   * Column to perform the default sorting
	   *
	   * @var string
	   */
	protected $orderColumn = 'lft';

	public $translatedAttributes = ['name', 'description'];
	
	protected $nativeNameCache = [];

	/**
	 * Columns which restrict what we consider our Nested Set list
	 *
	 * @var array
	 */
	protected $scoped = ['country_id'];

	public function setDepth() {

		$this->saveTranslations();
		return parent::setDepth();
	}

	public function regionType()
	{
		return $this->belongsTo('Vinfo\RegionType');
	}

	public function country()
	{
		return $this->belongsTo('Vinfo\Country');
	}

	public function shortcut()
	{
		return $this->belongsTo('Vinfo\Region', 'shortcut_id');
	}

	public function geometries()
	{
		return $this->morphMany('Vinfo\Geometry', 'gzeometried');
	}

    public function getAttribute($key)
    {
    	if ($key == 'name' && $this->region_type_id == 1) {
			return $this->country->name;
		}

        if (str_contains($key, ':')) {
            list($key, $locale) = explode(':', $key);
        } else {
            $locale = $this->locale();
        }
        if ($this->isTranslationAttribute($key)) {
            if ($this->getTranslation($locale) === null) {
                return;
            }
            return $this->getTranslation($locale)->$key;
        }
        return parent::getAttribute($key);
    }

	public function getNativeNameAttribute()
	{
		if (empty($this->native_name_cache)) {
			$translations = $this->native_names_translations;
			$this->native_name_cache = $translations->lists('name', 'locale')->toArray() ?: [$this->name];
		}
		
		return $this->native_name_cache;
	}

	public function native_names_translations()
	{
		return $this->translations()->where('is_native', true);
	}

    public function getParentIdSelectAttribute()
    {
        if ($this->parent) {

            $transformer = new RegionTransformer;

            return json_encode($transformer->transform($this->parent));
        }

        return '';
    }

    public function getShortcutIdSelectAttribute()
    {
        if ($this->shortcut) {

            $transformer = new RegionTransformer;

            return json_encode($transformer->transform($this->parent));
        }

        return '';
    }

    public static function getSelect($id)
    {
        if ($id) {

            $transformer = new RegionTransformer;
            $selected = Region::find($id);

            return json_encode($transformer->transform($selected));
        }

        return '';
    }

}
