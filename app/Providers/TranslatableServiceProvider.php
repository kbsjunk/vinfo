<?php

namespace Vinfo\Providers;

use Illuminate\Support\ServiceProvider;
use Vinfo\CurrencyTranslation;
use Vinfo\CountryTranslation;
use Vinfo\BottleSizeTranslation;
use Config;

class TranslatableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		CurrencyTranslation::saved(function($translation) { $this->preventEmptyTranslation($translation); });
		CountryTranslation::saved(function($translation) { $this->preventEmptyTranslation($translation); });
		BottleSizeTranslation::saved(function($translation) { $this->preventEmptyTranslation($translation); });
    }
		
	private function preventEmptyTranslation($translation)
	{
		if ($this->hasNoFilledAttributes($translation)) {
			if ($translation->exists) {
				$translation->delete();
			}
			return false;
		}
	}
	
	private function hasNoFilledAttributes($translation)
	{
		$parent = get_class($translation);
		$suffix = Config::get('translatable.translation_suffix', 'Translation');
		$parent = str_replace($suffix, '', $parent);
		$parent = new $parent;
		$translatedAttributes = $parent->translatedAttributes;
		$attributes = array_only($translation->getAttributes(), $translatedAttributes);
		$attributes = array_filter($attributes);
		return count($attributes) == 0;
	}

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
