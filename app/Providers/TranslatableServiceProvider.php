<?php

namespace Vinfo\Providers;

use Illuminate\Support\ServiceProvider;
use Vinfo\CurrencyTranslation;
use Vinfo\CountryTranslation;
use Vinfo\BottleSizeTranslation;
use Vinfo\ConsumedReasonTranslation;
use Vinfo\RegionTypeTranslation;
use Vinfo\RegionTranslation;
use Config;

use Punic\Territory;

use Kitbs\Collator\Collator as KitbsCollator;

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
    	ConsumedReasonTranslation::saved(function($translation) { $this->preventEmptyTranslation($translation); });
    	RegionTypeTranslation::saved(function($translation) { $this->preventEmptyTranslation($translation); });
    	RegionTranslation::saved(function($translation) { $this->preventEmptyTranslation($translation); });

    	RegionTranslation::saving(function($translation) { $this->isNativeTranslation($translation); });
        CountryTranslation::saving(function($translation) { $this->isNativeTranslation($translation); });
    	
        CurrencyTranslation::saving(function($translation) { $this->getSortAs($translation); });
        CountryTranslation::saving(function($translation) { $this->getSortAs($translation); });
        BottleSizeTranslation::saving(function($translation) { $this->getSortAs($translation); });
        ConsumedReasonTranslation::saving(function($translation) { $this->getSortAs($translation); });
        RegionTypeTranslation::saving(function($translation) { $this->getSortAs($translation); });
        RegionTranslation::saving(function($translation) { $this->getSortAs($translation); });
    }

    private function getSortAs($translation)
    {
        // $coll = collator_create( $translation->locale );
        // $translation->sortas = collator_get_sort_key($coll, $translation->name);
        $translation->sortas = KitbsCollator::getCollationKey($translation->name, $translation->locale);
    }

    private function isNativeTranslation($translation)
    {
    	if ($translation instanceof RegionTranslation) {
    		$country = $translation->region->country->code;
    	}
    	elseif ($translation instanceof CountryTranslation) {
    		$country = $translation->country->code;
    	}
    	else {
    		return;
    	}
    	
    	$locale = str_replace('-', '_', $translation->locale);

    	$languages = Territory::getLanguages($country, 'of', true);
    	$languages[] = $locale.'_'.$country;
    	$translation->is_native = in_array($locale, $languages);
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
