<?php

if (! function_exists('sentence_case')) {
	/**
     * Convert a value to title case.
     *
     * @param  string  $value
     * @return string
     */
	function sentence_case($value)
	{
		return mb_convert_case(mb_substr($value, 0, 1, 'UTF-8'), MB_CASE_UPPER, 'UTF-8').mb_substr($value, 1, null, 'UTF-8');
	}
}

if (! function_exists('get_locales')) {

	function get_locales($withGeneric = false) {
		$app = app();
		$localesConfig = (array) $app['config']->get('translatable.locales');
		
		if (empty($localesConfig)) {
			return [$app->getLocale()];
		}
		$locales = [];
		foreach ($localesConfig as $key => $locale) {
			if (is_array($locale)) {
				if ($withGeneric) $locales[] = $key;
				foreach ($locale as $countryLocale) {
					$locales[] = $key.$app['config']->get('translatable.locale_separator', '-').$countryLocale;
				}
			} else {
				$locales[] = $locale;
			}
		}
		return $locales;
	}
}