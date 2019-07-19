<?php

namespace Spotahome\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(\Spotahome\Repositories\Property\PropertyRepository::class, \Spotahome\Repositories\Property\XmlPropertyRepository::class);
        $this->app->when(\Spotahome\Http\Controllers\HtmlPropertyController::class)
            ->needs(\Spotahome\Formatters\Property\PropertyFormatter::class)
            ->give(function () {
                return new \Spotahome\Formatters\Property\HtmlPropertyFormatter;
            });
        $this->app->when(\Spotahome\Http\Controllers\DownloadPropertyController::class)
            ->needs(\Spotahome\Formatters\Property\PropertyFormatter::class)
            ->give(function () {
                return new \Spotahome\Formatters\Property\JsonPropertyFormatter;
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }
}
