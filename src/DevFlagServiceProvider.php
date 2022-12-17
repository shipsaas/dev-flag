<?php

namespace ShipSaaS\DevFlag;

use ShipSaaS\DevFlag\Contracts\DevFlagInterface;
use ShipSaaS\DevFlag\Services\DevFlagProcessor;
use Illuminate\Support\ServiceProvider;

class DevFlagServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DevFlagInterface::class, DevFlagProcessor::class);
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/Configs/devflag.php' => config_path('devflag.php'),
        ], 'devflag');

        $this->mergeConfigFrom(
            __DIR__.'/Configs/devflag.php',
            'devflag'
        );
    }
}
