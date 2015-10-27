<?php

namespace Kitbs\Geoimport\Geometry;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

use GeoJson\Geometry\Point as BasePoint;

class Point extends BasePoint implements GeometryInterface, Jsonable, Arrayable {

	use GeometryOutputTrait;

	public function centroid()
	{
		return clone $this;
	}

	public function pointOnSurface()
	{
		return clone $this;
	}

	public function area()
	{
		return 0;
	}

	public function convexHull()
	{
		dd([$this->getCoordinates(), $this->getCoordinates(), $this->getCoordinates(), $this->getCoordinates()]);
		return new Polygon([$this->getCoordinates(), $this->getCoordinates(), $this->getCoordinates(), $this->getCoordinates()]);
	}

	public function boundingBox()
	{
		return $this->convexHull();
	}

	public function simplify()
	{
		return clone $this;
	}

	public function distanceTo(Geometry $geometry, $unit = 'km')
	{
		
	}

	public function hausdorffDistanceTo(Geometry $geometry, $unit = 'km')
	{

	}

	public function union(Geometry $geometry)
	{

	}


}