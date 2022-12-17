<?php

namespace ShipSaaS\DevFlag\Contracts;

interface DevFlagInterface
{
    public function can(string $flagName): bool;
    public function fake(string $flag, bool $value): void;
}
