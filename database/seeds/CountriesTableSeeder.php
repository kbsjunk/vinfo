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
        // $locales = get_locales(true);

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

            $nameEn = Territory::getName($code, 'en');

            foreach ($locales as $key => $locale) {
				if (is_array($locale)) {
					$country[$key] = [
						'name' => Territory::getName($code, $key),
					];
					foreach ($locale as $countryLocale) {
						$name = Territory::getName($code, $key.'-'.$countryLocale);

						if ($name != $country[$key]['name'] && $name != $nameEn) {
							$country[$key.'-'.$countryLocale] = [
								'name' => $name,
							];
						}
					}
				}
				else {
					$name = Territory::getName($code, $locale);
					if ($name != $nameEn) {
						$country[$locale] = [
							'name' => $name,
						];
					}
				}
			}

            $country = Country::create($country);

            $langs = Territory::getLanguages($code, 'of', true);
            $langs = array_map(function($lang) {
            	return str_replace('_', '-', $lang);
            }, $langs);
            $langs = array_diff($langs, get_locales(true));

            foreach ($langs as $lang) {
            	$name = Territory::getName($code, str_replace('-', '_', $lang));

            	$translation = $country->getNewTranslation($lang);
            	$translation->name = $name;
            	$translation->country_id = $country->id;
            	$translation->save();
            }
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
