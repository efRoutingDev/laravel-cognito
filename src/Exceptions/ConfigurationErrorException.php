<?php

namespace Efrouting\LaravelCognito\Exceptions;

use Throwable;
use RuntimeException;

class ConfigurationErrorException extends RuntimeException
{
    public function __construct($message = 'Invalid configuration', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}