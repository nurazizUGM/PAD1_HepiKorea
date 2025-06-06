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
        if (strpos(env('APP_URL', ''), 'https') === 0) {
            URL::forceScheme('https');
        }

        if (env('APP_DEBUG', false)) {
            config()->push('app.providers', 'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider');
        }
    }
}
