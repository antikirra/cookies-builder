<?php

namespace Antikirra\Cookies;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

final class Builder
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $_path;

    /**
     * @var DateTimeInterface|null
     */
    private $_expires;

    /**
     * @var string
     */
    private $_domain;

    /**
     * @var bool
     */
    private $_secure;

    /**
     * @var bool
     */
    private $_hostOnly;

    /**
     * @var bool
     */
    private $_httpOnly;

    /**
     * @var SameSite|null
     */
    private $_sameSite;

    /**
     * @param string $name
     * @param string $value
     */
    private function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @param string $name
     * @param string $value
     * @return self
     */
    public static function create($name, $value = '')
    {
        return new self($name, $value);
    }

    public static function remove($name)
    {
        $self = new self($name, '');
        $expires = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '1970-01-01 00:00:00', new DateTimeZone('UTC'));
        $self->expires($expires);

        return $self;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function path($value)
    {
        $this->_path = $value;
        return $this;
    }

    /**
     * @param DateTimeInterface|null $value
     * @return $this
     */
    public function expires(DateTimeInterface $value = null)
    {
        if (null !== $value) {
            $this->_expires = $value;
        }

        return $this;
    }

    /**
     * @param string $value
     * @return self
     */
    public function domain($value)
    {
        $this->_domain = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return self
     */
    public function secure($value = true)
    {
        $this->_secure = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return self
     */
    public function httpOnly($value = true)
    {
        $this->_httpOnly = $value;
        return $this;
    }

    /**
     * @param bool $value
     * @return self
     */
    public function hostOnly($value = true)
    {
        $this->_hostOnly = $value;
        return $this;
    }

    /**
     * @param SameSite $value
     * @return self
     */
    public function sameSite(SameSite $value = null)
    {
        $this->_sameSite = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function build()
    {
        $parts = [];

        $parts[] = urlencode($this->name) . '=' . urlencode($this->value);

        if (!empty($this->_domain)) {
            $parts[] = "Domain={$this->_domain}";
        }

        $parts[] = 'Path=' . (!empty($this->_path) ? $this->_path : '/');

        if ($this->_expires instanceof DateTimeInterface) {
            $parts[] = 'Expires=' . ($this->_expires->format('D, d M Y H:i:s \G\M\T'));
        }

        if ($this->_secure === true) {
            $parts[] = 'Secure';
        }

        if ($this->_hostOnly === true) {
            $parts[] = 'HostOnly';
        }

        if ($this->_httpOnly === true) {
            $parts[] = 'HttpOnly';
        }

        if ($this->_sameSite instanceof SameSite) {
            $parts[] = 'SameSite=' . $this->_sameSite;
        }

        return implode('; ', $parts);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->build();
    }
}
