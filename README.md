# Simple Cookies Builder

## Install

```console
composer require antikirra/cookies-builder
```

## Basic usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$builder = \Antikirra\Cookies\Builder::create('token', 'xaz8BXsTr2XGF9FYc3ckaeKpeyEdrAP4');

// `__toString()` same as `->build()`
echo $builder
    ->expires((new DateTimeImmutable())->modify('+1 year'))
    ->secure()
    ->httpOnly();

// token=xaz8BXsTr2XGF9FYc3ckaeKpeyEdrAP4; Path=/; Expires=Mon, 27 Jan 2025 14:25:57 GMT; Secure; HttpOnly

$builder = \Antikirra\Cookies\Builder::remove('token');

$header = $builder->build();

echo $header; // token=; Path=/; Expires=Thu, 01 Jan 1970 00:00:00 GMT
```
