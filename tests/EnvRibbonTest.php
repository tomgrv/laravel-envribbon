<?php

namespace Perspikapps\EnvRibbon\Tests;

use Orchestra\Testbench\TestCase;
use Perspikapps\EnvRibbon\Facades\EnvRibbon;
use Perspikapps\EnvRibbon\ServiceProvider;

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
