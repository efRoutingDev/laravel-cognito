<?php

namespace Efrouting\LaravelCognito\Traits;

use Efrouting\LaravelCognito\Models\EfToken;

trait EfUserTrait
{
    use CognitoUser;

    public function GetEfUser() : ?EfToken
    {
        $user = $this->GetUser();
        if(empty($user)) {
            return null;
        }
        
        return new EfToken($user);
    }
}