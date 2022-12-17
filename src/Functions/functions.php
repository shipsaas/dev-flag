<?php

use ShipSaaS\DevFlag\Contracts\DevFlagInterface;

if (!function_exists('useDevFlag')) {
    /**
     * Quick helper to use DevFlag
     *
     * @param string $flagName
     *
     * @return bool
     */
    function useDevFlag(string $flagName): bool
    {
        return app(DevFlagInterface::class)->can($flagName);
    }
}
