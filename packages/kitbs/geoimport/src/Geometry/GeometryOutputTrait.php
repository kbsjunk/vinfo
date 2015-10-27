<?php

namespace Kitbs\Geoimport\Geometry;

trait GeometryOutputTrait {

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