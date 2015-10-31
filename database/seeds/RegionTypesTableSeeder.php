<?php

use Illuminate\Database\Seeder;

use Vinfo\RegionType;

class RegionTypesTableSeeder extends Seeder {

	public function run()
	{

		DB::table('region_types')->delete();

		$regions = [
		1 => [
		'en'      => 'Country',
		'de'      => 'Land',
		'fr'      => 'Pays',
		'zh'      => '国家',
		'zh-Hant' => '國家',
		],
		2 => [
		'en' => 'State',
		'de' => 'Bundesland',
		'fr' => 'État',
		'zh' => '州',
		],
		3 => [
		'en' => 'Province',
		'de' => 'Provinz',
		],
		4 => [
		'en' => 'Territory',
		'de' => 'Territorium',
		'fr' => 'Territoire',
		],
		5 => [
		'en' => 'Superzone',
		],
		6 => [
		'en' => 'Zone',
		],
		7 => [
		'en' => 'Region',
		'fr' => 'Région',
		'de' => 'Gebiet',
		],
		8 => [
		'en' => 'Subregion',
		'fr' => 'Sous-région',
		],
		9 => [
		'en' => 'District',
		'de' => 'Bereich',
		],
		10 => [
		'en' => 'Area',
		],
		11 => [
		'en' => 'American Viticultural Area',
		'es' => 'Área Vitivinícola Americana',
		'fr' => 'Région viticole américaine',
		],
		12 => [
		'en' => 'Appellation',
		],
		13 => [
		'en' => 'Collective Sub-Appellation',
		],
		14 => [
		'en' => 'Sub-Appellation',
		'fr' => 'Sous-appellation',
		],
		15 => [
		'en' => 'Districtus Austriae Controllatus',
		],
/* 		16 => [
		'de' => 'Großlage',
		],
		17 => [
		'de' => 'Einzellage',
		], */
		];

		foreach ($regions as $id => $locales) {
			$region = [
				'id' => $id,
			];
			
			foreach ($locales as $locale => $name) {
				$region[$locale] = ['name' => $name];
			}
			
			// RegionType::updateOrCreate(['id' => $id], $region);
			RegionType::create($region);
		}
	}

}