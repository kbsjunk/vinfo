<?php

namespace Kitbs\Geoimport\WKT;

use GeoIO\Factory;
use GeoIO\Dimension;

use Kitbs\Geoimport\Geometry\Geometry;
use Kitbs\Geoimport\Geometry\GeometryCollection;
use Kitbs\Geoimport\Geometry\Point;
use Kitbs\Geoimport\Geometry\Polygon;
use Kitbs\Geoimport\Geometry\LineString;
use Kitbs\Geoimport\Geometry\LinearRing;
use Kitbs\Geoimport\Geometry\MultiLineString;
use Kitbs\Geoimport\Geometry\MultiPoint;
use Kitbs\Geoimport\Geometry\MultiPolygon;

class Writer implements Factory
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