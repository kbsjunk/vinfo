<?php

namespace Kitbs\Geoimport;

use GEOSGeometry;
use GEOSWKTReader;
use GEOSWKTWriter;

use Kitbs\Geoimport\Generator;
use GeoIO\WKT\Parser\Parser;


use mcordingley\LinearAlgebra\Matrix;
use GeoJson\Geometry\Geometry;

class Inspector {

	protected $reader;
	protected $writer;
	protected $matrix;

	public function __construct()
	{
		$this->reader = new GEOSWKTReader();
		$this->writer = new GEOSWKTWriter();
		$factory = new Kitbs\Geoimport\Generator();
		$this->parser = new GeoIO\WKT\Parser\Parser($factory); 

		$geo = $parser->parse($wkt);
	}
	
	public function centroid(Geometry $geometry)
	{

	}

	public function area(Geometry $geometry)
	{

	}

	public function convexHull(Geometry $geometry)
	{

	}

	public function boundingBox(Geometry $geometry)
	{

	}

	public function simplify(Geometry $geometry)
	{

	}

	public function distanceTo(Geometry $geometry)
	{

	}

	public function union(array $geometries)
	{

	}

	public function toArray(Geometry $geometry)
	{

	}

	public function toJson(Geometry $geometry, $options = 0)
	{

	}

	public function toGeoJson(Geometry $geometry, $options = 0)
	{

	}

	public function toWkt(Geometry $geometry)
	{

	}

	public function toWkb(Geometry $geometry)
	{

	}

	public function fromWkt($string)
	{

	}

	public function fromWkb($string)
	{

	}

	public function fromGeoJson($string)
	{

	}

	public function rotate(Geometry $geometry, $angle = 90)
	{
		$matrix = new Matrix([[cos($angle), sin($angle)], [-sin($angle), cos($angle)]]);

		

		$geometryMatrix = new Matrix($geometry->getCoordinates());
	}

	public function translate(Geometry $geometry, $x = 0, $y = 0)
	{
		$center = $this->centroid($geometry);
	}

	public function dilate(Geometry $geometry, $x = 0, $y = 0)
	{

	}

	public function scale(Geometry $geometry, $scale)
	{

	}

	public function reflect(Geometry $geometry, $axis = 'x')
	{
		if ($axis == 'x') {
			$matrix = new Matrix([[1, 0], [0, -1]]);
		}
		elseif ($axis == 'y') {
			$matrix = new Matrix([[-1, 0], [0, 1]]);
		}
	}

	public function reflectX(Geometry $geometry)
	{
		return $this->reflect($geometry, 'x');
	}


	public function reflectY(Geometry $geometry)
	{
		return $this->reflect($geometry, 'y');
	}

	private function zeroPosition(Geometry $geometry)
	{
		
	}

	private function resetPosition(Geometry $geometry)
	{

	}

	private function toGeos(Geometry $geometry)
	{
		return $this->reader->read($this->toWkt($geometry));
	}

	private function fromGeos(GEOSGeometry $geosGeometry)
	{
		return $this->parser->parse($this->writer->write($geosGeometry));
	}


}

// $reflectX      = new Matrix([[ 1,  0], [ 0, -1]]);
// $reflectY      = new Matrix([[-1,  0], [ 0,  1]]);
// $reflectOrigin = new Matrix([[-1,  0], [ 0, -1]]);
// $reflectLineXY = new Matrix([[ 0,  1], [ 1,  0]]);
// $rotateCC90    = new Matrix([[ 0,  1], [-1,  0]]);
// $rotateCC180   = new Matrix([[-1,  0], [ 0, -1]]);
// $rotateCC270   = new Matrix([[ 0, -1], [ 1,  0]]);

// $xPoint = $center->getX();
// $yPoint = $center->getY();

// foreach ($coordinates as &$xy) {
// 	$xy[0] = $xy[0]-$xPoint;
// 	$xy[1] = $xy[1]-$yPoint;
// }