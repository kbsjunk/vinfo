<?php

namespace Vinfo;

use Illuminate\Database\Eloquent\Model;
use Kitbs\Geoimport\HasGeometry;

use Illuminate\Database\Eloquent\Relations\Relation;

class Geometry extends Model
{
	use HasGeometry;
	
	protected $fillable = [
		'name',
		'description',
        'geometry',
		'geometry_json',
        'properties',
		'all_properties',
	];

	protected $casts = [
		'geometry' => 'geometry',
	/* 		'centroid' => 'geometry', */
	];

    public static function boot()
    {
        parent::boot();
        Relation::morphMap(static::$geometriedTypes);
    }

    protected static $geometriedTypes = [
        'Region'  => 'Vinfo\Region',
        'Country' => 'Vinfo\Country',
        'Winery'  => 'Vinfo\Winery',
    ];

    protected static $transformers = [
        'Region'  => 'Vinfo\Transformers\RegionTransformer',
        'Country' => 'Vinfo\Transformers\CountryTransformer',
        'Winery'  => 'Vinfo\Transformers\WineryTransformer',
    ];
	
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public function doGeometryChecks($force = false)
    {
    		if (empty($this->quality) || $force) {
				$this->quality = count(array_flatten($this->geometry->getCoordinates())) / 2;
    		}
    		if (empty($this->shape) || $force) {
    			$this->shape = strtolower($this->geometry->getType());
    		}
    		// if (empty($this->centroid) || $force) {
    		// 	$this->centroid = // FIXME
    		// }
    }

    public function geometried()
    {
    	return $this->morphTo();
    }

    public function getGeometriedSelectAttribute()
    {
        if ($this->geometried) {

            $transformer = static::$transformers[$this->geometried_type];
            $transformer = new $transformer;

            return json_encode($transformer->transform($this->geometried));
        }

        return '';
    }

    public static function getGeometriedSelect($geometried, $geometried_type)
    {
        // dd($geometried, $geometried_type);
        if ($geometried && $geometried_type) {

            $transformer = static::$transformers[$geometried_type];
            $transformer = new $transformer;
            $geometried_type = static::$geometriedTypes[$geometried_type];
            $geometried = with(new $geometried_type)->find($geometried);

            return json_encode($transformer->transform($geometried));
        }

        return '';
    }

    public function getGeometryJsonAttribute()
    {
        return json_encode($this->getAttribute($this->getGeometryField())->jsonSerialize(), JSON_PRETTY_PRINT);
    }

    public function setGeometryJsonAttribute($json)
    {
        return $this->geometry = $json;
    }

}
