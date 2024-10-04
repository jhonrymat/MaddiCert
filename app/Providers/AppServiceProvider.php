<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
    $cachePath = base_path('app/bootstrap/cache');

    if (!is_dir($cachePath)) {
        mkdir($cachePath, 0755, true);
    }
}
}
