<?php

namespace Perspikapps\LaravelEnvRibbon\Tests;

use Orchestra\Testbench\TestCase;
use Perspikapps\LaravelEnvRibbon\Facades\EnvRibbon;

class EnvRibbonTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'env-ribbon' => EnvRibbon::class,
        ];
    }

    public function testExample()
    {
        $this->assertEquals(1, 1);
    }
}
