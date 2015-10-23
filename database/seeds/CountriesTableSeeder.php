<?php

use Illuminate\Database\Seeder;
use Punic\Data;
use Punic\Territory;
use Vinfo\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        $locales = Config::get('translatable.locales');

        $countries = Territory::getCountries('en');
		
		$producing = [
			'AL','AM','AR','AT','AU','AZ','BA','BE','BG','BO','BR',
			'BY','CA','CH','CL','CN','CU','CY','CZ','DE','DZ','EE',
			'EG','ES','ET','FR','GB','GE','GR','HR','HU','IL','IT',
			'JO','JP','KG','KZ','LB','LI','LT','LU','LV','LY','MA',
			'MD','ME','MG','MK','MT','MX','NZ','PA','PE','PT','PY',
			'RE','RO','RS','RU','SI','SK','SY','TJ','TM','TN','TR',
			'UA','US','UY','UZ','VN','ZA','ZW',
			'CSHH','CSXX','SUHH','YUCS',
		];

        foreach ($countries as $code => $void) {

            $country = [
                'code' => $code,
				'is_wine' => in_array($code, $producing),
            ];

            foreach ($locales as $key => $locale) {
				if (is_array($locale)) {
					$country[$key] = [
						'name' => Territory::getName($code, $key),
					];
					foreach ($locale as $countryLocale) {
						if (($name = Territory::getName($code, $key.'-'.$countryLocale)) != $country[$key]['name']) {
							$country[$key.'-'.$countryLocale] = [
								'name' => $name,
							];
						}
					}
				}
				else {
					$country[$locale] = [
						'name' => Territory::getName($code, $locale),
					];
				}
            }
			
			if (isset($country['zh']['name'])) {
				$country['zh-Latn-pinyin']['name'] = Pinyin::trans($country['zh']['name']);
			}

            $country = Country::create($country);
        }
		
		$countries = [
			'CSHH' => 'Czechoslovakia',
			'CSXX' => 'Serbia and Montenegro',
			'SUHH' => 'Soviet Union',
			'YUCS' => 'Yugoslavia',
		];
		
		foreach ($countries as $code => $name)
		{
			$country = [
                'code' => $code,
				'is_wine' => in_array($code, $producing),
				'en' => [
	                'name' => $name,
				],
            ];
			
			$country = Country::create($country);
		}

    }
}
