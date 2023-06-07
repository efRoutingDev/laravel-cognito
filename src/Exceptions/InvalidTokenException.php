<?php

namespace Efrouting\LaravelCognito\Exceptions;

use Throwable;
use RuntimeException;


class InvalidTokenException extends RuntimeException
{
    public function __construct($message = 'Invalid token', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
