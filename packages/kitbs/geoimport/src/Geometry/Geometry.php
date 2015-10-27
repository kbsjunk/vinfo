<?php

namespace Kitbs\Geoimport\Geometry;

use GeoJson\Geometry\Geometry as BaseGeometry;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

abstract class Geometry extends BaseGeometry implements GeometryInterface, Jsonable, Arrayable {

	public function centroid()
	{

	}

	public function area()
	{

	}

	public function convexHull()
	{

	}

	public function boundingBox()
	{

	}

	public function simplify()
	{

	}

	public function distanceTo(Geometry $geometry)
	{

	}

	public function union(Geometry $geometry)
	{

	}

	public function toArray()
	{
		return $this->jsonSerialize();
	}

	public function toJson($options = 0)
	{
		return json_encode($this->toArray(), $options);
	}

	public function toGeoJson($options = 0)
	{
		return $this->toJson($options);
	}

	public function toWkt()
	{

	}

	public function toWkb()
	{

	}

	public function __toString()
	{
		return $this->toWkt();
	}

}