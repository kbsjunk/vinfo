<?php

namespace Vinfo\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \Vinfo\User::class       => \Vinfo\Policies\UserPolicy::class,
        \Vinfo\BottleSize::class => \Vinfo\Policies\BottleSizePolicy::class,
        \Vinfo\Country::class    => \Vinfo\Policies\CountryPolicy::class,
        \Vinfo\Currency::class   => \Vinfo\Policies\CurrencyPolicy::class,
        \Vinfo\Language::class   => \Vinfo\Policies\LanguagePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

    }
}
