<?php

namespace Efrouting\LaravelCognito\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CognitoAuthorizationMiddleware extends BaseMiddleware
{
    public function handle(Request $request, Closure $next) : Response
    {
        $userToken = null;
        try
        {
            $userToken = $this->cognito->authorize();    
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if(empty($userToken)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Add the user token to the request attributes so we can retrieve it later
        $request->attributes->add(['cognito_user' => $userToken]);

        return $next($request);
    }
}