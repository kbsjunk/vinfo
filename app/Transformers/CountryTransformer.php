<?php
namespace Vinfo\Transformers;

use Vinfo\Country;
use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
{
	public function transform(Country $country)
	{
	    return [
			'id'      => (int) $country->id,
			'name'    => $country->name,
			'subname' => $country->code,
			'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/admin/countries/'.$country->id,
                ]
            ],
	    ];
	}
}