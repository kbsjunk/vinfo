<?php

namespace Kitbs\Geoimport;

use Kitbs\Geoimport\Generator;
use Kitbs\Geoimport\Extractor;
use GeoIO\WKT\Parser\Parser;

trait HasGeometry {

    /**
     * Boot the geometry trait for a model.
     *
     * @return void
     */
    public static function bootHasGeometry()
    {
        static::addGlobalScope(new GeometryScope);
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
            $this->attributes = $this->fromGeometry($value);
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
        $parser = new Parser($factory);

        return $parser->parse($value);
    }

    protected function fromGeometry($value)
    {

    }

    protected function toFeature()
    {

    }

}

        // Geometry::saving(function($geo)
        // {
        //     foreach ($geo->getGeometry() as $column) {
        //         if ($geo->isDirty($column) || true) {
        //             if ($geo->getAttribute($column) instanceof GeoPHP\Geometry\Geometry) {
        //                 $geo->attributes[$column] = DB::raw('GeomFromText(\''.$geo->getAttribute($column)->asText().'\')');
        //             }
        //             else {
        //                 $geo->attributes[$column] = DB::raw('GeomFromText(\'POINT(0 0)\')');;
        //             }
        //         }
        //     }

        // });