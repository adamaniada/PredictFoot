<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('apiService', function ($app) {
            return new \App\Services\ApiService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
