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
			$key = preg_replace('@models/[^./]+@', 'models/default', $key);
			$line = parent::get($key, $replace, $locale);
		}
		
		return $line;
    }
}
