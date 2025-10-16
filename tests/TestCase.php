<?php

namespace Cjmellor\BoostIdeBundle\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Cjmellor\BoostIdeBundle\BoostIdeBundleServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            BoostIdeBundleServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // No database configuration required for this package
    }
}
