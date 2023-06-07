<?php

namespace Efrouting\LaravelCognito\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

class CognitoAuthorizationMiddleware extends BaseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}