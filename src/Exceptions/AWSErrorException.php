<?php

namespace Efrouting\LaravelCognito\Exceptions;

use Throwable;
use RuntimeException;

class AWSErrorException extends RuntimeException
{
    public function __construct($message = 'AWS Error', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}