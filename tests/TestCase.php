<?php

namespace ShipSaaS\DevFlag\Tests;

use ShipSaaS\DevFlag\DevFlagServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;

    protected function getPackageProviders($app): array
    {
        return [
            DevFlagServiceProvider::class,
        ];
    }
}
