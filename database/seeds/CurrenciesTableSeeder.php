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
        
        $commonCurrencies = array_keys(PunicCurrency::getAllCurrencies(false, false, 'en'));

        $locales = Config::get('translatable.locales');

        foreach ($currencies as $code => $name) {

            $currency = [
                'code'    => $code,
                'is_used' => in_array($code, $commonCurrencies),
            ];

			foreach ($locales as $key => $locale) {

				if (is_array($locale)) {
					$currency[$key] = [
						'name' => PunicCurrency::getName($code, null, $key),
					];
					foreach ($locale as $countryLocale) {
						if (($name = PunicCurrency::getName($code, null, $key.'-'.$countryLocale)) != $currency[$key]['name']) {
							$currency[$key.'-'.$countryLocale] = [
								'name' => $name,
							];
						}
					}
				}
				else {
					$currencyName = PunicCurrency::getName($code, null, $locale);

					if ($currencyName || $locale == 'en')
					{
						$currency[$locale] = [
							'name' => $currencyName ?: $name,
						];
					}
				}
			}

            Currency::create($currency);
        }

        $extras = [
         'GGP' => '根西岛镑',
         'JEP' => '泽西岛镑',
         'IMP' => '马恩岛镑',
         'BTC' => '比特币',
        ];

        foreach ($extras as $code => $name) {
            if ($currency = Currency::whereCode($code)->first()) {
                $currency->fill(['zh-Hans' => ['name' => $name]]);
                $currency->save();
            }
        }

    }
}
