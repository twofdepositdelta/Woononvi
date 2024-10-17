<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

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
        Response::macro('success', function ($data = [], $message = 'Succès', $code = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ], $code);
        });

        Response::macro('error', function ($message = 'Erreurr', $code = 400, $errors = []) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors' => $errors
            ], $code);
        });
    }
}
