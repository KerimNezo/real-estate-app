<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ImageConversionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ImageConversionService::class, function () {
            return new ImageConversionService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
