# Laravel DevFlag / FeatureFlag - ShipSaaS

[![Build and test [PHP8.1]](https://github.com/shipsaas/dev-flag/actions/workflows/build_php81.yml/badge.svg)](https://github.com/shipsaas/dev-flag/actions/workflows/build_php81.yml)
[![codecov](https://codecov.io/gh/shipsaas/dev-flag/branch/main/graph/badge.svg?token=4WAI95PDUT)](https://codecov.io/gh/shipsaas/dev-flag)

DevFlag (aka Feature Flag) enabling your Application Development to follow the CI/CD best practices.

## Support
- PHP 8.0+
- Laravel 9.x & 10.x

## Install

```bash
composer require shipsaas/dev-flag
```

Then hit this to get the `devflag.php` to your codebase:

```bash
php artisan vendor:publish --tag=devflag
```

## Deep dive

### Problems

IRL projects, definitely there would be PRs that contains a lot of changes (thousands of lines, 50+ files). 
For those PRs, even you have 10 people to review, they still won't cover everything 100%. Simply because it is too much.

Everybody loves small PRs and that is the undeniable fact. But how can we achieve it?

Welcome to DevFlag!

### Solutions
DevFlag will help you to achieve that. Not only the tool, but also require a bit of your critical thinking.

Before starting development, you need to ensure:

- The scope, the changes that you will do (aka Technical Breakdown)
  - This is the most important phase, you need to finalize the:
    - Schema changes: avoid updating too much
    - Code
- Create a DevFlag
- Start the development

Further reading for the PROs:

- [Practical on DevFlag](https://antman-does-software.com/dev-flags-supercharge-your-continuous-deployment-by-dropping-database-feature-toggles)

## Usage

### Add a new Flag

Open the `app/devflag.php`, prepare your application's environments. Add your flag into all envs:

```php
return [
    'local' => [
        'useNewFeature' => true,
    ],
    'testing' => [
        'useNewFeature' => true,
    ],
    'staging' => [
        'useNewFeature' => false,
    ],
    'production' => [
        'useNewFeature' => false,
    ],
];
```

### Check

Func-way:

```php
function transfer(): ?Transaction
{
    $useNewFeature = useDevFlag('useNewFeature');

    if (!$useNewFeature) {
        return null;
    }

    // doing awesome things
    
    return $transaction;
}
```

OOP/DI-way:

```php
use ShipSaaS\DevFlag\Contracts\DevFlagInterface;

public function __construct(private DevFlagInterface $devFlag) {}

public function transfer(): mixed
{
    if (!$this->devFlag->can('useNewFeature')) {
        return null;
    }
    
    // handle new things
}
```

## IRL Use cases

Check out WIKI: https://github.com/shipsaas/dev-flag/wiki

## Contribution rules
- Follow PSR-1 & PSR-12 coding conventions
- TDD is a must

Feel free to open a PR 😉

## Maintainer
- @sethsandaru

## License

MIT License
