<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
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
        if(!$this->app->environment('local'))
        {
            $this->app['request']->server->set('HTTPS','on');
        }
        $this->app->resolving(LengthAwarePaginator::class,function($paginator)
        {
            return $paginator->appends(Arr::except(request()->query(),$paginator->getPageName()));
        });
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
