<?php

namespace Antikirra\Cookies;

final class SateSiteNone extends SameSite
{
    /**
     * @return string
     */
    public function __toString()
    {
        return 'None';
    }
}
