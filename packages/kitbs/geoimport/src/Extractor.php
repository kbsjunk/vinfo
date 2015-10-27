<?php

namespace Kitbs\Geoimport;

use GeoIO\Extractor as BaseExtractor;
use GeoIO\Dimension;

use GeoJson\Geometry\GeometryCollection;
use GeoJson\Geometry\LineString;
use GeoJson\Geometry\LinearRing;
use GeoJson\Geometry\MultiLineString;
use GeoJson\Geometry\MultiPoint;
use GeoJson\Geometry\MultiPolygon;
use GeoJson\Geometry\Point;
use GeoJson\Geometry\Polygon;

class Extractor implements BaseExtractor
{
    /**
     * @param $geometry
     * @return boolean
     */
    public function supports($geometry)
    {
    	
    }

    /**
     * @param mixed $geometry
     * @return string One of the Dimension::DIMENSION_* constants
     */
    public function extractDimension($geometry)
    {
    	return Dimension::DIMENSION_2D;
    }

    /**
     * @param mixed $geometry
     * @return integer|null
     */
    public function extractSrid($geometry)
    {
    	
    }

	/**
     * @param mixed $geometry
     * @return string One of the Extractor::TYPE_* constants
     */
	public function extractType($geometry)
	{
		if ($geometry instanceof Point) return self::TYPE_POINT;
		if ($geometry instanceof LineString) return self::TYPE_LINESTRING;
		if ($geometry instanceof Polygon) return self::TYPE_POLYGON;
		if ($geometry instanceof MultiPoint) return self::TYPE_MULTIPOINT;
		if ($geometry instanceof MultiLineString) return self::TYPE_MULTILINESTRING;
		if ($geometry instanceof MultiPolygon) return self::TYPE_MULTIPOLYGON;
		if ($geometry instanceof GeometryCollection) return self::TYPE_GEOMETRYCOLLECTION;
	}

    /**
     * @param mixed $point
     * @return array
     */
    public function extractCoordinatesFromPoint($point)
    {

    	$dimension = $point instanceof Point ? $this->extractDimension($point) : Dimension::DIMENSION_2D;

    	$z = $m = null;

    	switch ($dimension) {
    		case Dimension::DIMENSION_3DZ:
    			$z = 3;
    			break;
    		case Dimension::DIMENSION_3DM:
    			$m = 3;
    			break;
    		case Dimension::DIMENSION_4D:
    			$z = 3;
    			$m = 4;
    			break;
    	}

    	return [
			'x' => $this->extractCoordinateFromPoint($point, 0),
			'y' => $this->extractCoordinateFromPoint($point, 1),
			'z' => $z ? $this->extractCoordinateFromPoint($point, $z) : null,
			'm' => $m ? $this->extractCoordinateFromPoint($point, $m) : null,
    	];
    }

    private function extractCoordinateFromPoint($point, $index)
    {
    	return $point instanceof Point ? $point->getCoordinates()[$index] : $point[$index];
    }

    /**
     * @param mixed $lineString
     * @return array|Traversable
     */
    public function extractPointsFromLineString($lineString)
    {
    	return $lineString instanceof LineString ? $lineString->getCoordinates() : $lineString;
    }

    /**
     * @param mixed $polygon
     * @return array|Traversable
     */
    public function extractLineStringsFromPolygon($polygon)
    {
    	return $polygon instanceof Polygon ? $polygon->getCoordinates() : $polygon;
    }

    /**
     * @param mixed $multiPoint
     * @return array|Traversable
     */
    public function extractPointsFromMultiPoint($multiPoint)
    {
    	return $multiPoint instanceof MultiPoint ? $multiPoint->getCoordinates() : $multiPoint;
    }

    /**
     * @param mixed $multiLineString
     * @return array|Traversable
     */
    public function extractLineStringsFromMultiLineString($multiLineString)
    {
    	return $multiLineString instanceof MultiLineString ? $multiLineString->getCoordinates() : $multiLineString;
    }

    /**
     * @param mixed $multiPolygon
     * @return array|Traversable
     */
    public function extractPolygonsFromMultiPolygon($multiPolygon)
    {
    	return $multiPolygon instanceof MultiPolygon ? $multiPolygon->getCoordinates() : $multiPolygon;
    }

    /**
     * @param mixed $geometryCollection
     * @return array|Traversable
     */
    public function extractGeometriesFromGeometryCollection($geometryCollection)
    {
    	return $geometryCollection instanceof GeometryCollection ? $geometryCollection->getGeometries() : $geometryCollection;
    }

}