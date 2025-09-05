<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Multitenancy\Multitenancy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Multitenancy::startingToMakeCurrent(function ($tenant) {
            //
        });
    }
}
