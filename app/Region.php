<?php

namespace Vinfo;

use Baum\Node;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dimsav\Translatable\Translatable;
use Vinfo\Traits\TranslatableSortable;

class Region extends Node {

	use SoftDeletes;
    use Translatable;
    use TranslatableSortable;

	protected $fillable = [
		'name',
		'description',
		'is_structural',
	];

    public $fieldTypes = [
    	'description' => 'textarea'
    ];

    public $translatedAttributes = ['name', 'description'];

	/**
	 * Columns which restrict what we consider our Nested Set list
	 *
	 * @var array
	 */
	protected $scoped = ['country_id'];

	public function setDepth() {
		$self = $this;

		$this->saveTranslations();

		$this->getConnection()->transaction(function() use ($self) {
			$self->reload();

			$level = $self->getLevel();

			$self->newNestedSetQuery()->where($self->getKeyName(), '=', $self->getKey())->update(array($self->getDepthColumnName() => $level));
			$self->setAttribute($self->getDepthColumnName(), $level);
		});

		return $this;
	}

	public function regionType()
	{
		return $this->belongsTo('Vinfo\RegionType');
	}

	public function country()
	{
		return $this->belongsTo('Vinfo\Country');
	}
	
	public function geometries()
	{
		return $this->morphMany('Vinfo\Geometry', 'geometried');
	}

}
