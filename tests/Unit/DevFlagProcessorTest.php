<?php

namespace ShipSaaS\DevFlag\Tests\Unit;

use ShipSaaS\DevFlag\DevFlag;
use ShipSaaS\DevFlag\Tests\TestCase;
use RuntimeException;

class DevFlagProcessorTest extends TestCase
{
    public function testDevFlagReturnsTrueForEnabledFlag()
    {
        $this->app->detectEnvironment(fn () => 'local');

        $this->assertTrue(useDevFlag('useNewFeature'));
        $this->assertTrue(DevFlag::can('useNewFeature'));
    }

    public function testDevFlagReturnsFalseForDisabledFlag()
    {
        $this->app->detectEnvironment(fn () => 'staging');

        $this->assertFalse(useDevFlag('useNewFeature'));
        $this->assertFalse(DevFlag::can('useNewFeature'));
    }

    public function testDevFlagCanFakeForTestingEnvironment()
    {
        DevFlag::fake('useNewFeature', false);

        $this->assertFalse(useDevFlag('useNewFeature'));

        DevFlag::fake('useNewFeature', true);

        $this->assertTrue(useDevFlag('useNewFeature'));
    }

    public function testDevFlagCannotFakeForLocalEnvironment()
    {
        $this->app->detectEnvironment(fn () => 'staging');

        $this->expectException(RuntimeException::class);
        DevFlag::fake('useNewFeature', true);
    }
}
