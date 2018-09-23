<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Api\BitbucketApiService;
use League\CommonMark\CommonMarkConverter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindInstances();
        $this->bindSingletons();
    }

    public function bindSingletons()
    {
        $this->app->singleton('AuthenticatedUser', function () {
            return auth()->user();
        });

        $this->app->singleton(CommonMarkConverter::class, function ($app) {
            return new CommonMarkConverter();
        });
    }

    public function bindInstances()
    {
        $this->app->bind(BitbucketApiService::class, function ($app) {
            return new BitbucketApiService($app->make('AuthenticatedUser'));
        });
    }
}
