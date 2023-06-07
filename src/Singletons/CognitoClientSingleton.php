<?php

namespace Efrouting\LaravelCognito\Singletons;

use Aws\Credentials\Credentials;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;

class CognitoClientSingleton
{
    private $initialized = false;

    protected $cognitoClient;

    public function init(): void 
    {
        if ($this->initialized) {
            return;
        }

        $credentials = new Credentials(
            config('AWS_ACCESS_KEY_ID'), 
            env('AWS_SECRET_ACCESS_KEY'), null);

        $this->cognitoClient = new CognitoIdentityProviderClient([
            'version' => config('cognito.aws_version'),
            'region' => config('cognito.aws_region'),
            'credentials' => $credentials,
        ]);

        $this->initialized = true;
    }

    public function getClient(): CognitoIdentityProviderClient
    {
        if (!$this->initialized) {
            $this->init();
        }

        return $this->cognitoClient;
    }
}