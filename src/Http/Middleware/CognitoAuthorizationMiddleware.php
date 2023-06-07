<?php

namespace Efrouting\LaravelCognito\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CognitoAuthorizationMiddleware extends BaseMiddleware
{
    public function handle(Request $request, Closure $next) : Response
    {
        try
        {
            $this->cognito->authorize();
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}