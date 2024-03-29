<?php

declare(strict_types=1);

namespace Casperlaitw\SSO\Broker;

/**
 * Exception thrown when a request is done while no session is attached
 */
class NotAttachedException extends \RuntimeException
{
}
