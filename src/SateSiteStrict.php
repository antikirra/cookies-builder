<?php

declare(strict_types=1);

namespace Antikirra\Cookies;

final class SateSiteStrict extends SameSite
{
    public function __toString(): string
    {
        return 'Strict';
    }
}
