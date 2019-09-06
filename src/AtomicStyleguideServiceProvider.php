<?php

namespace ReinVanOyen\AtomicStyleguide;

use Illuminate\Support\ServiceProvider;

class AtomicStyleguideServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Styleguide::class, Styleguide::class);

        $this->mergeConfigFrom(
            __DIR__.'/../config/styleguide.php',
            'styleguide'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/styleguide.php' => config_path('styleguide.php'),
        ], 'styleguide');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/atomic-styleguide'),
        ], 'styleguide');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'styleguide');
    }
}