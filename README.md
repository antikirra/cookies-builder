# Simple Cookies Builder

![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/antikirra/cookies-builder/php)
![Packagist Version](https://img.shields.io/packagist/v/antikirra/cookies-builder)

## Install

```console
composer require antikirra/cookies-builder:^2.0
```

## Basic usage

```php
<?php

declare(strict_types=1);

use Antikirra\Cookies\Builder;

require __DIR__ . '/vendor/autoload.php';

$builder = Builder::create('token', 'xaz8BXsTr2XGF9FYc3ckaeKpeyEdrAP4');

// `__toString()` same as `->build()`
echo $builder
    ->expires((new DateTimeImmutable())->modify('+1 year'))
    ->build();

// token=xaz8BXsTr2XGF9FYc3ckaeKpeyEdrAP4; Path=/; Expires=Tue, 04 Feb 2025 00:00:00 GMT; Secure; HttpOnly

$builder = Builder::remove('token');

echo $builder->build();

// token=; Path=/; Expires=Thu, 01 Jan 1970 00:00:00 GMT; Secure; HttpOnly
```
