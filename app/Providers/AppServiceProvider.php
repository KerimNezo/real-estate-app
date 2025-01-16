<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ImageConversionService;
use App\Services\PropertyDataConversionService;

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

        $this->app->singleton(PropertyDataConversionService::class, function () {
            return new PropertyDataConversionService();
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
