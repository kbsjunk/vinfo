<?php

namespace Kitbs\Viewgen;

use Illuminate\Support\ServiceProvider;

class ViewGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerViewGenerator();
    }

    /**
     * Register the make:view generator.
     * 
     * @return void
     */
    private function registerViewGenerator()
    {
        $this->app->singleton('command.viewgen.view', function ($app) {
            return $app['Kitbs\Viewgen\ViewMakeCommand'];
        });

        $this->commands('command.viewgen.view');

        $this->app->singleton('command.viewgen.lang', function ($app) {
            return $app['Kitbs\Viewgen\LangMakeCommand'];
        });

        $this->commands('command.viewgen.lang');
    }
}
