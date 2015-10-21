<?php

namespace Kitbs\Geoimport;

use GeoIO\Factory as BaseFactory;

class Factory implements BaseFactory
{
	public function createPoint($dimension, array $coordinates, $srid = null)
	{
		return MyPoint($coordinates['x'], $coordinates['y']);
	}

	public function createLineString($dimension, array $points, $srid = null)
	{
		return MyLineString($points);
	}

    
}