<?php

namespace Efrouting\LaravelCognito\Http\Middleware;

class CognitoAuthorizationMiddleware extends BaseMiddleware
{
    public function handle($request, $next)
    {
        return $next($request);
    }
}