<?php

namespace Perspikapps\LaravelEnvRibbon;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use AvtoDev\AppVersion\AppVersionManager;
use Illuminate\Contracts\Http\Kernel;
use Perspikapps\LaravelEnvRibbon\Middleware\InjectLaravelEnvRibbon;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/laravel-env-ribbon.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('laravel-env-ribbon.php'),
        ], 'laravel-env-ribbon');


        $this->registerMiddleware(InjectLaravelEnvRibbon::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'laravel-env-ribbon'
        );

        /*
        * Register the service provider for the dependency.
        */
        $this->app->register(\AvtoDev\AppVersion\ServiceProvider::class);

        $this->app->singleton(LaravelEnvRibbon::class, function ($app) {
            return new LaravelEnvRibbon($app, $app->make('AvtoDev\AppVersion\AppVersionManagerInterface'));
        });
    }

    /**
     * Register the Middleware
     *
     * @param  string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [LaravelEnvRibbon::class];
    }
}
