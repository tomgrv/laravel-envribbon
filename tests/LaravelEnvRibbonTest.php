<?php

namespace Perspikapps\LaravelEnvRibbon\Tests;

use Perspikapps\LaravelEnvRibbon\Facades\LaravelEnvRibbon;
use Perspikapps\LaravelEnvRibbon\ServiceProvider;
use Orchestra\Testbench\TestCase;

class LaravelEnvRibbonTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'laravel-env-ribbon' => LaravelEnvRibbon::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
