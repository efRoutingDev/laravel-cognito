<?php

namespace Efrouting\LaravelCognito\Http\Middleware;

use Closure;
use Efrouting\LaravelCognito\Exceptions\AWSErrorException;
use Efrouting\LaravelCognito\Exceptions\ConfigurationErrorException;
use Efrouting\LaravelCognito\Exceptions\InvalidTokenException;
use Efrouting\LaravelCognito\Exceptions\NoTokenException;
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
        catch(ConfigurationErrorException $e)
        {
            return response()->json(['error' => 'Config error'], 401);
        }
        catch(NoTokenException $e)
        {
            return response()->json(['error' => 'No token'], 401);
        }
        catch(InvalidTokenException $e)
        {
            return response()->json(['error' => 'Invalid token'], 401);
        }
        catch(AWSErrorException $e)
        {
            return response()->json(['error' => 'AWS error'], 401);
        }
        

        if(empty($userToken)) {
            return response()->json(['error' => 'Empty token'], 401);
        }

        // Add the user token to the request attributes so we can retrieve it later
        $request->attributes->add(['cognito_user' => $userToken]);

        return $next($request);
    }
}