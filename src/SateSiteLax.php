<?php

namespace Antikirra\Cookies;

final class SateSiteLax extends SameSite
{
    /**
     * @return string
     */
    public function __toString()
    {
        return 'Lax';
    }
}
