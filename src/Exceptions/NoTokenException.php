<?php

namespace Efrouting\LaravelCognito\Exceptions;

use Throwable;
use RuntimeException;


class NoTokenException extends RuntimeException
{
    public function __construct($message = 'Token is null or empty', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
