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

        Data::setDefaultLocale(Config::get('app.locale'));
        Data::setFallbackLocale(Config::get('app.fallback_locale'));

        $locales = Config::get('translatable.locales');

        $countries = Territory::getCountries();
		
		$producing = [
			'AL','AM','AR','AT','AU','AZ','BA','BE','BG','BO','BR',
			'BY','CA','CH','CL','CN','CU','CY','CZ','DE','DZ','EE',
			'EG','ES','ET','FR','GB','GE','GR','HR','HU','IL','IT',
			'JO','JP','KG','KZ','LB','LI','LT','LU','LV','LY','MA',
			'MD','ME','MG','MK','MT','MX','NZ','PA','PE','PT','PY',
			'RE','RO','RS','RU','SI','SK','SY','TJ','TM','TN','TR',
			'UA','US','UY','UZ','VN','ZA','ZW','CSHH','CSXX','SUHH','YUCS',
		];

        foreach ($countries as $code => $name) {

            $country = [
                'code' => $code,
				'is_wine' => in_array($code, $producing),
            ];

            foreach ($locales as $locale) {
                $country[$locale] = [
                    'name' => Territory::getName($code, $locale),
                ];
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

        Data::setDefaultLocale(Config::get('app.locale'));

    }
}
