<?php

namespace Efrouting\LaravelCognito\Singletons;

use Aws\Credentials\Credentials;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Firebase\JWT\JWK;
use Illuminate\Support\Facades\Http;

class CognitoClientSingleton
{
    protected $cognitoClient;
    private $jwtKey = null;
    private $jwkKey = null;

    public function __construct()
    {
        $this->jwtKey = config('cognito.jwtKeys');

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

    public function getJwkKey()
    {
        if(!empty($this->jwkKey)) {
            return $this->jwkKey;
        }

        $this->jwkKey = JWK::parseKeySet($this->jwtKey);
        return $this->jwkKey;
    }
}