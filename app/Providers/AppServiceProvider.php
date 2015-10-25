<?php

namespace Vinfo\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Punic\Language;
use Locale;
use App;
use Exception;

use GeoJson\GeoJson;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
	public function boot()
	{
		Validator::extend('geometry', function($attribute, $value, $parameters, $validator) {
            $value = json_decode($value);
            try {
                $value = GeoJson::jsonUnserialize($value);
                return $value instanceof GeoJson;
            }
            catch (Exception $e) {
                return false;
            }
        });
	}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
