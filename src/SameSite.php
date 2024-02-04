<?php

declare(strict_types=1);

namespace Antikirra\Cookies;

abstract class SameSite
{
    abstract public function __toString(): string;
}
