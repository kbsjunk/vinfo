<?php

namespace Vinfo\Http\Controllers;

use Illuminate\Http\Request;
use Vinfo\Http\Requests;
use Vinfo\Http\Controllers\Controller;

use Punic\Territory as PunicTerritory;
use Punic\Language as PunicLanguage;
use Punic\Currency as PunicCurrency;

use Vinfo\Country;
use Vinfo\Language;
use Vinfo\Currency;

use Config;
use Locale;

class ApiController extends Controller
{

    public function languageNameByLanguageId($code)
    {
        return [
            'name' => PunicLanguage::getName($code, $code),
        ];
    }

    public function languageAndCurrencyByCountry($id)
    {
        $country = Country::find($id);

        if ($country) {

            $code = $country->code;

            $languages = PunicTerritory::getLanguages($code, 'of', true);
            $languages = array_map(function($value) { return str_replace('_', '-', $value); }, $languages);
            $allLanguages = Language::lists('code')->toArray();
            $languages = array_intersect(array_merge((array) $languages, ['en']), $allLanguages);
            $language = head($languages);

            $allCurrencies = Currency::lists('code')->toArray();
            $currencies = PunicCurrency::getCurrencyForTerritory($code);
            $currencies = array_intersect(array_merge((array) $currencies, ['GBP']), $allCurrencies);
            $currency = head($currencies);

            $language = Language::whereCode($language)->first();
            $currency = Currency::whereCode($currency)->first();

            return [
                'language_id' => $language->id,
                'currency_id' => $currency->id,
            ];
        }
        else {
            return response('error', 404);
        }
    }

}
