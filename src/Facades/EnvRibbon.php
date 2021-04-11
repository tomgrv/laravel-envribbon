<?php

namespace Perspikapps\LaravelEnvRibbon\Facades;

use Illuminate\Support\Facades\Facade;

class EnvRibbon extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'envribbon';
    }
}
