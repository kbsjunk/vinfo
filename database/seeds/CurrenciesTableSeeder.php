<?php

use Illuminate\Database\Seeder;
use SebastianBergmann\Money\Currency as MoneyCurrency;
use Punic\Data;
use Punic\Currency as PunicCurrency;
use Vinfo\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('currencies')->delete();

		$currencies = json_decode(file_get_contents('https://openexchangerates.org/api/currencies.json?app_id=74e989a64ee04c2283c3f3a7ca631d1d'));

        Data::setDefaultLocale(Config::get('app.locale'));
        Data::setFallbackLocale(Config::get('app.fallback_locale'));

        $locales = Config::get('translatable.locales');

        foreach ($currencies as $code => $name) {

            $currency = [
                'code' => $code,
            ];

            foreach ($locales as $locale) {
            	$currencyName = PunicCurrency::getName($code, null, $locale);
            	if ($currencyName || $locale == 'en')
            	{
            		$currency[$locale] = [
            		'name' => $currencyName ?: $name,
            		];
            	}
            }

            Currency::create($currency);
        }

        $extras = [
         'GGP' => '根西岛镑',
         'JEP' => '泽西岛镑',
         'IMP' => '马恩岛英镑',
         'BTC' => '比特币',
        ];

        foreach ($extras as $code => $name) {
            $currency = Currency::whereCode($code)->first();
            $currency->translate('zh-Hans')->name = $name;
            $currency->save();
        }

        Data::setDefaultLocale(Config::get('app.locale'));
    }
}
