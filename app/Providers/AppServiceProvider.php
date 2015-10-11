<?php

namespace Vinfo\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Punic\Language;
use Locale;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Validator::extend('locale', function($attribute, $value, $parameters) {
        //     $locale = Locale::parseLocale($value);
        //     dd(Locale::getDisplayName($value));
        //     return Language::getName($value) === $value;
        // });
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
