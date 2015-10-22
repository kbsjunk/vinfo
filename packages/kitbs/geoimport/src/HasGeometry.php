<?php

namespace Kitbs\Geoimport;

use Kitbs\Geoimport\Generator;
use Kitbs\Geoimport\Extractor;
use Kitbs\Geoimport\Collection;

use GeoJson\GeoJson;
use GeoJson\Geometry\Geometry;
use GeoJson\Geometry\GeometryCollection;
use GeoJson\Feature\Feature;
use GeoJson\Feature\FeatureCollection;

use GeoIO\WKT\Parser\Parser as WKTParser;
use GeoIO\WKT\Generator\Generator as WKTGenerator;

use DB;
use Exception;

// https://github.com/mjaschen/phpgeo
// https://github.com/toin0u/Geotools-laravel --> https://github.com/thephpleague/Geotools
// https://github.com/geocoder-php/Geocoder

trait HasGeometry {
	
	protected $propertiesField = 'properties';
	protected $geometryField = 'geometry';
	protected $nameField = 'name';
	protected $descriptionField = 'description';

    /**
     * Boot the geometry trait for a model.
     *
     * @return void
     */
    public static function bootHasGeometry()
    {
        static::addGlobalScope(new GeometryScope);

        static::saving(function($model)
        {
            foreach ($model->getGeometries() as $column) {
                if ($model->isDirty($column)) {
                    $model->attributes[$column] = DB::raw('GeomFromText(\''.strtoupper($model->attributes[$column]).'\')');
                }
				if (empty($model->attributes[$column])) {
                    $model->attributes[$column] = DB::raw('GeomFromText(\'POINT(0 0)\')');
				}
            }

        });
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Kitbs\Geoimport\Collection
     */
    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

    /**
     * Get all of the geometry attributes on the model.
     *
     * @return array
     */
    public function getGeometries()
    {
        $geometries = array_filter($this->casts, function($val) {
            return in_array($val, ['geo', 'geometry', 'geography'], true);
        });

        return array_keys($geometries);
    }

    /**
     * Cast an attribute to a native PHP type.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return mixed
     */
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        switch ($this->getCastType($key)) {
            case 'geometry':
            case 'geography':
            case 'geo':
            return $this->toGeometry($value);
            default:
            return parent::castAttribute($key, $value);
        }
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed   $value
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        if ($this->isGeoCastable($key)) {
            return $this->attributes[$key] = $this->fromGeometry($value);
        }

        return parent::setAttribute($key, $value);
    }
	
	public function getPropertiesField()
	{
		return $this->propertiesField ?: 'properties';
	}
	
	public function getGeometryField()
	{
		return $this->geometryField ?: 'geometry';
	}
	
	public function getNameField()
	{
		return $this->nameField;
	}
	
	public function getDescriptionField()
	{
		return $this->descriptionField;
	}
	
    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return static
     */
    public static function createFromFeature(Feature $feature, array $attributes = [])
    {
		$instance = new static;
		
		$properties = [
			$instance->getPropertiesField() => array_filter($feature->getProperties()),
			$instance->getGeometryField() => $feature->getGeometry(),
		];
		
		$attributes = array_merge($attributes, $properties);
		
        return parent::create($attributes);
    }

    /**
     * Determine whether a value is JSON castable for inbound manipulation.
     *
     * @param  string  $key
     * @return bool
     */
    protected function isGeoCastable($key)
    {
        return $key == $this->getGeometryField() || ($this->hasCast($key) &&
        in_array($this->getCastType($key), ['geo', 'geometry', 'geography'], true));
    }

    protected function toGeometry($value)
    {
        $factory = new Generator();
        $parser = new WKTParser($factory);

        return $parser->parse($value);
    }

    protected function fromGeometry($geometry)
    {
		if ($geometry instanceof Geometry) {

			$extractor = new Extractor();
			$generator = new WKTGenerator($extractor);

			return $generator->generate($geometry);
		}
		elseif (is_string($geometry)) {
			if (json_decode($geometry)) {
				$geometry = json_decode($geometry);
				$geometry = GeoJson::jsonUnserialize($geometry);
				if ($geometry instanceof Feature) {
					$geometry = $geometry->getGeometry();
				}
				elseif ($geometry instanceof FeatureCollection) {
					$geometries = [];
					foreach ($geometry->getFeatures() as $feature) {
						$geometries[] = $feature->getGeometry();
					}
					return $this->fromGeometry(new GeometryCollection($geometries));
				}
				if ($geometry instanceof Geometry) {
					return $this->fromGeometry($geometry);
				}
			}
			
			try {
				if ($this->toGeometry($geometry)) {
					return $geometry;
				}
			}
			catch (Exception $e) {}
		} 
        
        return 'POINT(0 0)';
    }

    /**
     * Convert the model's attributes to an array.
     *
     * @return array
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();

        foreach ($this->getGeometries() as $attribute) {
            $attributes[$attribute] = $this->getAttribute($attribute)->jsonSerialize();
        }

        return $attributes;
    }

    public function toFeature()
    {
        return new Feature($this->geometry, $this->properties, $this->id);
    }

    public function getPropertiesAttribute()
    {
        $properties = [
        'name'        => $this->getNameField() ? $this->getAttributeFromArray($this->getNameField()) : null,
        'description' => $this->getDescriptionField() ? $this->getAttributeFromArray($this->getDescriptionField()) : null,
        ];

		$arrayProperties = $this->getAttributeFromArray($this->getPropertiesField());
		
		if (!is_array($arrayProperties)) {
			$arrayProperties = json_decode($arrayProperties, true);
		}
		
        return array_merge($arrayProperties, $properties);
    }

    public function setPropertiesAttribute($properties)
    {
		if ($this->getNameField()) {
			$this->setAttribute($this->getNameField(), @$properties['name']);
			unset($properties['name']);
		}
		if ($this->getDescriptionField()) {
			$this->setAttribute($this->getDescriptionField(), @$properties['description']);
			unset($properties['description']);
		}

        $this->attributes[$this->getPropertiesField()] = json_encode($properties);
    }

}