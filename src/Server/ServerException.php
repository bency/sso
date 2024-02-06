<?php

declare(strict_types=1);

namespace Casperlaitw\SSO\Server;

/**
 * Exception that's thrown if something unexpectedly went wrong on the server.
 * Should result in an HTTP 5xx response.
 */
class ServerException extends \RuntimeException implements ExceptionInterface
{
}
