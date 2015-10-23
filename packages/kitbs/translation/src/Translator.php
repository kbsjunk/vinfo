<?php

namespace Kitbs\Translation;

use Illuminate\Translation\Translator as LaravelTranslator;

class Translator extends LaravelTranslator
{
    /**
     * Get the translation for the given key.
     *
     * @param  string  $key
     * @param  array   $replace
     * @param  string  $locale
     * @return string
     */
    public function get($key, array $replace = [], $locale = null)
    {
		$line = parent::get($key, $replace, $locale);

		if ($line == $key && strpos($line, 'models/') === 0) {
			$newkey = preg_replace('@models/[^./]+@', 'models/default', $key);
			$line = parent::get($newkey, $replace, $locale);
            if ($newkey == $line) {
                return $key;
            }
		}
		
		return $line;
    }
	
	/**
     * Get the array of locales to be checked.
     *
     * @param  string|null  $locale
     * @return array
     */
	protected function parseLocale($locale)
	{
		if (is_null($locale)) {
			$locale = $this->locale;
		}
		
		@list($fallback, $country) = explode(config('translatable.locale_separator', '-'), $locale);
		
		if ($fallback && $country) {
			return array_filter([$locale, $fallback, $this->fallback]);
		}
		return parent::parseLocale($locale);
	}
}
