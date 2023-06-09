<?php

namespace Efrouting\LaravelCognito\Exceptions;

use Throwable;
use RuntimeException;

class ExpiredTokenException extends RuntimeException
{
    public function __construct($message = 'Expired token', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}