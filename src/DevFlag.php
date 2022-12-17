<?php

namespace ShipSaaS\DevFlag;

use ShipSaaS\DevFlag\Services\DevFlagProcessor;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool can(string $flagName)
 * @method static void fake(string $flagName, bool $value)
 */
class DevFlag extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return DevFlagProcessor::class;
    }
}
