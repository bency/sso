<?php

namespace Casperlaitw\SSO\Legacy;

trait LegacyMode
{
    /**
     * @var int
     */
    protected $version = 2;

    /**
     * @return $this
     */
    public function latest()
    {
        $this->version = 2;
        return $this;
    }

    /**
     * @return $this
     */
    public function legacy()
    {
        $this->version = 1;

        return $this;
    }

    /**
     * @return bool
     */
    public function isLegacy()
    {
        return $this->version === 1;
    }
}
