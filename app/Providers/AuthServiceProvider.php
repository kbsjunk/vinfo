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
        \Vinfo\User::class           => \Vinfo\Policies\UserPolicy::class,
        
        \Vinfo\BottleSize::class     => \Vinfo\Policies\AdminPolicy::class,
        \Vinfo\Country::class        => \Vinfo\Policies\AdminPolicy::class,
        \Vinfo\Currency::class       => \Vinfo\Policies\AdminPolicy::class,
        \Vinfo\Language::class       => \Vinfo\Policies\AdminPolicy::class,
        \Vinfo\ConsumedReason::class => \Vinfo\Policies\AdminPolicy::class,
        \Vinfo\RegionType::class     => \Vinfo\Policies\AdminPolicy::class,
        \Vinfo\Region::class         => \Vinfo\Policies\AdminPolicy::class,
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
