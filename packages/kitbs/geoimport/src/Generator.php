<?php

namespace Kitbs\Geoimport;

use GeoIO\Factory as BaseFactory;
use GeoIO\Dimension;

use GeoJson\Geometry\GeometryCollection;
use GeoJson\Geometry\LineString;
use GeoJson\Geometry\LinearRing;
use GeoJson\Geometry\MultiLineString;
use GeoJson\Geometry\MultiPoint;
use GeoJson\Geometry\MultiPolygon;
use GeoJson\Geometry\Point;
use GeoJson\Geometry\Polygon;

class Generator implements BaseFactory
{
	public function createPoint($dimension, array $coordinates, $srid = null)
	{
        switch ($dimension) {
             case Dimension::DIMENSION_3DZ:
                 return new Point([$coordinates['x'], $coordinates['y'], $coordinates['z']]);
             case Dimension::DIMENSION_3DM:
                 return new Point([$coordinates['x'], $coordinates['y'], $coordinates['m']]);
             case Dimension::DIMENSION_4D:
                 return new Point([$coordinates['x'], $coordinates['y'], $coordinates['z'], $coordinates['m']]);
             default:
                 return new Point([$coordinates['x'], $coordinates['y']]);
         }
	}

	public function createLineString($dimension, array $points, $srid = null)
	{
		return new LineString($points);
	}

    public function createLinearRing($dimension, array $points, $srid = null)
    {
    	return new LinearRing($points);
    }

    public function createPolygon($dimension, array $lineStrings, $srid = null)
    {
    	return new Polygon($lineStrings);
    }

    public function createMultiPoint($dimension, array $points, $srid = null)
    {
    	return new MultiPoint($points);
    }

    public function createMultiLineString($dimension, array $lineStrings, $srid = null)
    {
    	return new MultiLineString($lineStrings);
    }

    public function createMultiPolygon($dimension, array $polygons, $srid = null)
    {
    	return new MultiPolygon($polygons);
    }

    public function createGeometryCollection($dimension, array $geometries, $srid = null)
    {
    	return new GeometryCollection($geometries);
    }
}