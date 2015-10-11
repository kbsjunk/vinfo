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

        foreach ($countries as $code => $name) {

            $country = [
                'code' => $code,
            ];

            foreach ($locales as $locale) {
                $country[$locale] = [
                    'name' => Territory::getName($code, $locale),
                ];
            }

            Country::create($country);
        }

        Data::setDefaultLocale(Config::get('app.locale'));

    }
}
