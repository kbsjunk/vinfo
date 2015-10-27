<?php

namespace Kitbs\Geoimport\Eloquent;

use Illuminate\Database\Eloquent\Collection as BaseCollection;
use GeoJson\Feature\FeatureCollection;

class Collection extends BaseCollection
{
	public function toFeatureCollection()
	{
		$features = $this->items;

		foreach ($features as &$feature) {
			$feature = $feature->toFeature();
		}

		return new FeatureCollection($features);
	}
}