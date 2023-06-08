<?php

namespace Efrouting\LaravelCognito\Traits;
use Efrouting\LaravelCognito\Models\Token;

use Illuminate\Http\Request;

trait CognitoUserTrait
{
    public function GetUser(Request $request) : ?Token
    {
        $userToken = $request->get('cognito_user');
        if(empty($userToken)) {
            return null;
        }

        return new Token($userToken);
    }
}