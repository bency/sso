<?php

declare(strict_types=1);

namespace Casperlaitw\SSO\Broker;

/**
 * Use global $_COOKIE and setcookie() to persist the client token.
 *
 * @implements \ArrayAccess<string,mixed>
 * @codeCoverageIgnore
 */
class Cookies implements \ArrayAccess
{
    /** @var int */
    protected $ttl;

    /** @var string */
    protected $path;

    /** @var string */
    protected $domain;

    /** @var bool */
    protected $secure;

    /**
     * Cookies constructor.
     *
     * @param int    $ttl     Cookie TTL in seconds
     * @param string $path
     * @param string $domain
     * @param bool   $secure
     */
    public function __construct(int $ttl = 3600, string $path = '/', string $domain = '', bool $secure = true)
    {
        $this->ttl = $ttl;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($name, $value): void
    {
        $success = setcookie(
            $name,
            $value,
            [
                'expires' => time() + $this->ttl,
                'path' => $this->path,
                'domain' => $this->domain,
                'secure' => $this->secure,
                'httponly' => true,
                'samesite' => 'Lax'
            ]
        );

        if (!$success) {
            throw new \RuntimeException("Failed to set cookie '$name'");
        }

        $_COOKIE[$name] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($name): void
    {
        setcookie(
            $name,
            '',
            [
                'expires' => time() - 3600,
                'path' => $this->path,
                'domain' => $this->domain,
                'secure' => $this->secure,
                'httponly' => true,
                'samesite' => 'Lax'
            ]
        );
        unset($_COOKIE[$name]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($name)
    {
        return $_COOKIE[$name] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($name): bool
    {
        return isset($_COOKIE[$name]);
    }
}
