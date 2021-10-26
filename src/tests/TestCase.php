<?php

namespace edwardyi\Press\Tests;

use edwardyi\Press\PressBaseServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    /**
     * Get package providers.
     * 
     * @param \Illuminate\Foundation\Application $app
     * 
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            PressBaseServiceProvider::class
        ];
    }
}