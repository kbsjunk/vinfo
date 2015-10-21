<?php

use Illuminate\Database\Seeder;

use Vinfo\RegionType;

class RegionTypesTableSeeder extends Seeder {

	public function run()
	{
		$regions = [
		[
		'en' => 'Country',
		],
		[
		'en' => 'State',
		],
		[
		'en' => 'Province',
		],
		[
		'en' => 'Territory',
		],
		[
		'en' => 'Superzone',
		],
		[
		'en' => 'Zone',
		],
		[
		'en' => 'Region',
		],
		[
		'en' => 'Subregion',
		],
		[
		'en' => 'District',
		],
		[
		'en' => 'Area',
		],
		];

		foreach ($regions as $region) {
			$region = [
				'en' => ['name' => $region['en']],
			];
			RegionType::create($region);
		}
	}

}