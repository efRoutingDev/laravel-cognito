<?php

namespace Efrouting\LaravelCognito\Traits;

use Illuminate\Http\Request;
use Efrouting\LaravelCognito\Models\EfToken;


trait EfUserTrait
{
    use CognitoUserTrait;

    public function GetEfUser(Request $request) : ?EfToken
    {
        $user = $this->GetUser($request);
        if(empty($user)) {
            return null;
        }
        
        return new EfToken($user);
    }
}