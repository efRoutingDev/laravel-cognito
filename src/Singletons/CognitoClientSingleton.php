<?php

namespace Efrouting\LaravelCognito\Singletons;

use Aws\Credentials\Credentials;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class CognitoClientSingleton
{
    protected $cognitoClient;

    public function __construct()
    {
        $credentials = new Credentials(
            config('cognito.aws_access_key'), 
            config('cognito.aws_secret_key'), null);

        $this->cognitoClient = new CognitoIdentityProviderClient([
            'version' => config('cognito.version'),
            'region' => config('cognito.region'),
            'credentials' => $credentials,
        ]);
    }

    public function getClient(): CognitoIdentityProviderClient
    {
        return $this->cognitoClient;
    }
}