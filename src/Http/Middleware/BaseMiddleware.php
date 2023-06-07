<?php

namespace Efrouting\LaravelCognito\Http\Middleware;
use Efrouting\LaravelCognito\AWSCognito;

class BaseMiddleware
{
    protected $cognito;

    public function __construct(AWSCognito $cognito)
    {
        $this->cognito = $cognito;
    }
}