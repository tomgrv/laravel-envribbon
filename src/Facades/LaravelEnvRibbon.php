<?php

namespace Perspikapps\LaravelEnvRibbon\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelEnvRibbon extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-env-ribbon';
    }
}
