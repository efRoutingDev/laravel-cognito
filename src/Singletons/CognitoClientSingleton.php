<?php

namespace Efrouting\LaravelCognito\Singletons;

use Aws\Credentials\Credentials;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Firebase\JWT\JWK;
use Illuminate\Support\Facades\Http;

class CognitoClientSingleton
{
    protected $cognitoClient;
    private $jsonWebKeyUrl = null;
    private $jwtKey = null;
    private $jwkKey = null;

    public function __construct()
    {
        $region = config('cognito.region');
        $userPoolId = config('cognito.uuser_pool_id');

        $this->jsonWebKeyUrl = "https://cognito-idp.{$region}.amazonaws.com/{$userPoolId}/.well-known/jwks.json";

        $credentials = new Credentials(
            config('cognito.aws_access_key'), 
            config('cognito.aws_secret_key'), null);

        $this->cognitoClient = new CognitoIdentityProviderClient([
            'version' => config('cognito.version'),
            'region' => $region,
            'credentials' => $credentials,
        ]);
    }

    public function getClient(): CognitoIdentityProviderClient
    {
        return $this->cognitoClient;
    }

    public function getJwtKey()
    {
        if(!empty($this->jwtKey)) {
            return $this->jwtKey;
        }

        $res = Http::get($this->jsonWebKeyUrl);
        if(!$res->ok()) {
            throw new \Exception('Unable to retrieve JWT key');
        }

        $this->jwtKey = $res->json();
        return $this->jwtKey;
    }

    public function getJwkKey()
    {
        if(!empty($this->jwkKey)) {
            return $this->jwkKey;
        }

        $this->jwkKey = JWK::parseKeySet($this->getJwtKey());
        return $this->jwkKey;
    }
}