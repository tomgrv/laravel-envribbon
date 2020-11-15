<!-- @format -->

# Laravel Env Ribbon

[![GitHub Workflow Status](https://github.com/perspikapps/laravel-env-ribbon/workflows/Run%20tests/badge.svg)](https://github.com/perspikapps/laravel-env-ribbon/actions)
[![styleci](https://styleci.io/repos/CHANGEME/shield)](https://styleci.io/repos/CHANGEME)

[![Packagist](https://img.shields.io/packagist/v/perspikapps/laravel-env-ribbon.svg)](https://packagist.org/packages/perspikapps/laravel-env-ribbon)
[![Packagist](https://poser.pugx.org/perspikapps/laravel-env-ribbon/d/total.svg)](https://packagist.org/packages/perspikapps/laravel-env-ribbon)
[![Packagist](https://img.shields.io/packagist/l/perspikapps/laravel-env-ribbon.svg)](https://packagist.org/packages/perspikapps/laravel-env-ribbon)

[![Commitizen friendly](https://img.shields.io/badge/commitizen-friendly-brightgreen.svg)](http://commitizen.github.io/cz-cli/) [![semantic-release](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg)](https://github.com/semantic-release/semantic-release)

[![Buy me a coffee](https://badgen.net/badge/buymeacoffe/tomgrv/yellow?icon=buymeacoffee)](https://buymeacoffee.com/tomgrv)

This package displays a top-left corner ribbon with APP_ENV value & version number on all pages

## Installation

Install via composer

```bash
composer require perspikapps/laravel-env-ribbon
```

### Publish package assets

```bash
php artisan vendor:publish --provider="Perspikapps\LaravelEnvRibbon\ServiceProvider"
```

## Usage

Version is handled by [avto-dev/app-version-laravel](https://github.com/avto-dev/app-version-laravel) package: fill in `VERSION` file at project root.

Fill in configuration according to your needs:

```php
return [

    'enabled' => env('APP_RIBBON', true),

    'environments' => [

        'production' => [
            'visible' =>
            env('APP_DEBUG', false),
            'color' => 'limeGreen',
        ],

        'staging' => [
            'visible' => true,
            'color' => 'darkorange',
        ],

        '*' => [
            'visible' => true,
            'color' => 'crimson',
        ]
    ]

];
```

## Security

If you discover any security related issues, please email
instead of using the issue tracker.

## Credits

-   [](https://github.com/perspikapps/laravel-env-ribbon)
-   [All contributors](https://github.com/perspikapps/laravel-env-ribbon/graphs/contributors)

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).
