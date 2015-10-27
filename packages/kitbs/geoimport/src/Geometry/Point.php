<?php

namespace Kitbs\Geoimport\Geometry;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

use GeoJson\Geometry\Point as BasePoint;

class Point extends BasePoint implements GeometryInterface, Jsonable, Arrayable {

	use GeometryOutputTrait;

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


}