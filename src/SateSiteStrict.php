<?php

namespace Antikirra\Cookies;

final class SateSiteStrict extends SameSite
{
    /**
     * @return string
     */
    public function __toString()
    {
        return 'Strict';
    }
}
