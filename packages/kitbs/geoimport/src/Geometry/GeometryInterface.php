<?php

namespace Kitbs\Geoimport\Geometry;

interface GeometryInterface {

	public function centroid();

	public function area();

	public function convexHull();

	public function boundingBox();

	public function simplify();

	public function distanceTo(Geometry $geometry, $unit = 'km');

	public function hausdorffDistanceTo(Geometry $geometry, $unit = 'km');

	public function union(Geometry $geometry);

	public function toArray();

	public function toJson($options = 0);

	public function toGeoJson($options = 0);

	public function toWkt();

	public function toWkb();

	public function __toString();

}