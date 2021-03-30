<?php

namespace Perspikapps\EnvRibbon\Facades;

use Illuminate\Support\Facades\Facade;

class EnvRibbon extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'env-ribbon';
    }
}
