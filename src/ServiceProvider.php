<?php

namespace Perspikapps\EnvRibbon;

use Illuminate\Contracts\Http\Kernel;
use Perspikapps\EnvRibbon\Middleware\InjectEnvRibbon;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/../config/env-ribbon.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('env-ribbon.php'),
        ], 'env-ribbon');

        $this->registerMiddleware(InjectEnvRibbon::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'env-ribbon'
        );

        /*
         * Register the service provider for the dependency.
         */
        $this->app->register(\AvtoDev\AppVersion\ServiceProvider::class);

        $this->app->singleton(EnvRibbon::class, function ($app) {
            return new EnvRibbon($app, $app->make('AvtoDev\AppVersion\AppVersionManagerInterface'));
        });
    }

    /**
     * Register the Middleware.
     *
     * @param string $middleware
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
        return [EnvRibbon::class];
    }
}
