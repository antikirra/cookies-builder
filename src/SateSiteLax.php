<?php

declare(strict_types=1);

namespace Antikirra\Cookies;

final class SateSiteLax extends SameSite
{
    public function __toString(): string
    {
        return 'Lax';
    }
}
