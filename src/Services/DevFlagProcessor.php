<?php

namespace ShipSaaS\DevFlag\Services;

use ShipSaaS\DevFlag\Contracts\DevFlagInterface;
use Illuminate\Contracts\Foundation\Application;
use RuntimeException;

class DevFlagProcessor implements DevFlagInterface
{
    private array $flag;

    public function __construct(private Application $laravel)
    {
        $this->flag = $this->laravel['config']->get('devflag') ?? [];

        if (empty($this->flag)) {
            throw new RuntimeException('`devflag` configuration is not found. Are you set it up properly?');
        }
    }

    public function can(string $flagName): bool
    {
        $environment = $this->laravel->environment();

        return $this->flag[$environment][$flagName] ?? false;
    }

    /**
     * Can only be used from 'testing' environment for testing purpose
     *
     * @param string $flag
     * @param bool $value
     *
     * @return void
     */
    public function fake(string $flag, bool $value): void
    {
        if (!$this->laravel->environment('testing')) {
            throw new RuntimeException('No fake outside testing');
        }

        /** @var self $instance */
        $instance = app(DevFlagInterface::class);
        $instance->setTestingFlag($flag, $value);

        app()->instance(DevFlagInterface::class, $instance);
    }

    private function setTestingFlag(string $flag, bool $value): void
    {
        $this->flag['testing'][$flag] = $value;
    }
}
