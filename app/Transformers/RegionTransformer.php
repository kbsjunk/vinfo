<?php
namespace Vinfo\Transformers;

use Vinfo\Region;
use League\Fractal\TransformerAbstract;

class RegionTransformer extends TransformerAbstract
{
	public function transform(Region $region)
	{
	    return [
			'id'      => (int) $region->id,
			'name'    => $region->name.', '.$region->country->name,
			'subname' => $region->regionType->name,
			'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/admin/regions/'.$region->id,
                ]
            ],
	    ];
	}
}