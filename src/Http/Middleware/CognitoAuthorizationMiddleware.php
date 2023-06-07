<?php

namespace Efrouting\LaravelCognito\Http\Middleware;

class CognitoAuthorizationMiddleware extends BaseMiddleware
{
    public function handle($request, $next)
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