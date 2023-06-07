<?php

namespace Efrouting\LaravelCognito\Http\Middleware;

use Closure;
use Request;
use Response;

class CognitoAuthorizationMiddleware extends BaseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}