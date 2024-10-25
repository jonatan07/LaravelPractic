<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Passport::ignoreRoutes();
    }
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        /*
        $this->registerPolicies();
        Passport::enablePasswordGrant();
        //Passport::routes();
        
        Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        
        Passport::tokensExpireIn(now()->addMinutes(5));
        Passport::refreshTokensExpireIn(now()->addMinutes(10));
        Passport::personalAccessTokensExpireIn(now()->addMinutes(30));
       */
    }
}
