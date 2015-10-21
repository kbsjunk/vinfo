<?php

namespace Kitbs\Geoimport;

use Kitbs\Geoimport\Generator;
use Kitbs\Geoimport\Extractor;
use Kitbs\Geoimport\Collection;

use GeoJson\Geometry\Geometry;
use GeoJson\Feature\Feature;

use GeoIO\WKT\Parser\Parser as WKTParser;
use GeoIO\WKT\Generator\Generator as WKTGenerator;

use DB;

trait HasGeometry {

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
                    $model->attributes[$column] = DB::raw('GeomFromText(\''.$model->attributes[$column].'\')');
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

    /**
     * Determine whether a value is JSON castable for inbound manipulation.
     *
     * @param  string  $key
     * @return bool
     */
    protected function isGeoCastable($key)
    {
        return $this->hasCast($key) &&
        in_array($this->getCastType($key), ['geo', 'geometry', 'geography'], true);
    }

    protected function toGeometry($value)
    {
        $factory = new Generator();
        $parser = new WKTParser($factory);

        return $parser->parse($value);
    }

    protected function fromGeometry($value)
    {
        if ($value instanceof Geometry) {

            $extractor = new Extractor();
            $generator = new WKTGenerator($extractor);

            return $generator->generate($value);
        }
        elseif (is_string($value))
        {
            return $value;
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
        'name'        => $this->name,
        'description' => $this->description,
        ];

        return array_merge((array) $this->getAttributeFromArray('properties'), $properties);
    }

    public function setPropertiesAttribute($properties)
    {
        if (isset($properties['name'])) $this->name = $properties['name'];
        if (isset($properties['description'])) $this->name = $properties['description'];

        $this->properties = array_except(['name', 'description']);
    }

}