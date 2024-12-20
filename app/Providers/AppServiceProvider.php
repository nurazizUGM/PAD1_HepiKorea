<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (env('FORCE_HTTPS')) {
            URL::forceScheme('https');
        }

        if (env('DEBUGBAR_ENABLED', false)) {
            config()->push('app.providers', 'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
        }
    }
}
