<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\InfoBipSmsService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('infobip-sms', function ($app) {
            return new InfoBipSmsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    
    }
}
