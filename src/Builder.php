<?php

declare(strict_types=1);

namespace Antikirra\Cookies;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;

final class Builder
{
    private string $name;
    private string $value;
    private string $path;
    private ?DateTimeInterface $expires = null;
    private string $domain;
    private bool $secure = true;
    private bool $httpOnly = true;
    private ?SameSite $_sameSite = null;

    private function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public static function create(string $name, string $value = ''): self
    {
        return new self($name, $value);
    }

    public static function remove(string $name): self
    {
        $self = new self($name, '');
        $expires = DateTimeImmutable::createFromFormat('U', '0', new DateTimeZone('UTC'));
        $self->expires($expires);

        return $self;
    }

    public function path(string $value): self
    {
        $this->path = $value;
        return $this;
    }

    public function expires(?DateTimeInterface $value): self
    {
        if ($value instanceof DateTimeInterface) {
            $this->expires = $value;
        }

        return $this;
    }

    public function domain(string $value): self
    {
        $this->domain = $value;
        return $this;
    }

    public function secure(bool $value = true): self
    {
        $this->secure = $value;
        return $this;
    }

    public function httpOnly(bool $value = true): self
    {
        $this->httpOnly = $value;
        return $this;
    }

    public function sameSite(?SameSite $value): self
    {
        if ($value instanceof SameSite) {
            $this->_sameSite = $value;
        }

        return $this;
    }

    public function build(): string
    {
        $parts = [];

        $parts[] = urlencode($this->name) . '=' . urlencode($this->value);

        if (!empty($this->domain)) {
            $parts[] = "Domain={$this->domain}";
        }

        $parts[] = 'Path=' . (!empty($this->path) ? $this->path : '/');

        if ($this->expires instanceof DateTimeInterface) {
            $parts[] = 'Expires=' . $this->expires->format('D, d M Y H:i:s \G\M\T');
        }

        if ($this->secure) {
            $parts[] = 'Secure';
        }

        if ($this->httpOnly) {
            $parts[] = 'HttpOnly';
        }

        if ($this->_sameSite instanceof SameSite) {
            $parts[] = 'SameSite=' . $this->_sameSite;
        }

        return implode('; ', $parts);
    }

    public function __toString(): string
    {
        return $this->build();
    }
}
