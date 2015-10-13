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
use Input;
use Locale;
use Lang;
use Cache;

use Stichoza\GoogleTranslate\TranslateClient;

class ApiController extends Controller
{

    public function languageNameByLanguageCode($code)
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

    public function translateWord()
    {
        $group = Input::get('group');
        $key = Input::get('key');
        $lang = Input::get('lang');

        $key = str_replace('.','/',$group).'.'.$key;

        if (Lang::has($key, 'en'))
        {
            $word = Lang::get($key, [], 'en');

            if ($translated = Cache::get($word.':'.$lang)) {
                // Cached
                // Cache::forget($word.':'.$lang);
            }
            else {
                $translated = TranslateClient::translate('en', $lang, $word);
                Cache::put($word.':'.$lang, $translated, 30);
            }
        }
        else {
            $translated = null;
        }

        $word = mb_convert_case(mb_substr($translated, 0, 1, 'UTF-8'), MB_CASE_UPPER, 'UTF-8').mb_substr($translated, 1, null, 'UTF-8');
        $word = str_replace([' .', '\''], ['.', '’'], $word);

        return ['word' => $word];
    }

}
