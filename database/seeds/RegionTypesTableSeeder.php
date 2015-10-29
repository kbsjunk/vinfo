<?php

use Illuminate\Database\Seeder;

use Vinfo\RegionType;

class RegionTypesTableSeeder extends Seeder {

	public function run()
	{

		// DB::table('region_types')->delete();

		$regions = [
		1 => [
		'en' => 'Country',
		],
		2 => [
		'en' => 'State',
		],
		3 => [
		'en' => 'Province',
		],
		4 => [
		'en' => 'Territory',
		],
		5 => [
		'en' => 'Superzone',
		],
		6 => [
		'en' => 'Zone',
		],
		7 => [
		'en' => 'Region',
		],
		8 => [
		'en' => 'Subregion',
		],
		9 => [
		'en' => 'District',
		],
		10 => [
		'en' => 'Area',
		],
		11 => [
		'en' => 'American Viticultural Area',
		],
		12 => [
		'en' => 'Appellation',
		],
		13 => [
		'en' => 'Collective Sub-Appellation',
		],
		14 => [
		'en' => 'Sub-Appellation',
		],
		];

		foreach ($regions as $id => $region) {
			$region = [
				'id' => $id,
				'en' => ['name' => $region['en']],
			];
			RegionType::updateOrCreate(['id' => $id], $region);
		}
	}

}