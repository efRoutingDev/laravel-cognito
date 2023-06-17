<?php

namespace Efrouting\LaravelCognito;
use Efrouting\LaravelCognito\Exceptions\AWSErrorException;
use Efrouting\LaravelCognito\Exceptions\InvalidTokenException;
use Efrouting\LaravelCognito\Exceptions\NoTokenException;
use Efrouting\LaravelCognito\Singletons\CognitoClientSingleton;

class AWSCognito
{
    private $parser;
    private $cognitoClient;

    public function __construct(CognitoClientSingleton $cognitoClient, TokenParser $parser)
    {
        $this->parser = $parser;
        $this->cognitoClient = $cognitoClient;
    }

    protected function getUser($token) : \Aws\Result
    {
        if(empty($token)) {
            throw new NoTokenException();
        }

        $user = null;
        try {
            $user = $this->cognitoClient->getClient()->adminGetUser([
                'UserPoolId' => config('cognito.user_pool_id'),
                'Username' => $token['username']
            ]);
        }
        catch (\Exception $e) {
            throw new AWSErrorException($e->getMessage());
        }

        if(empty($user)) {
            throw new InvalidTokenException();
        }

        return $user;
    }

    public function authorize() : \Aws\Result
    {
        $token = $this->parser->parse();
        if(empty($token)) {
            throw new NoTokenException();
        }

        $decodedToken = $this->parser->decode($token);
        if(empty($decodedToken)) {
            throw new InvalidTokenException();
        }

        return $this->getUser($decodedToken);
    }
}
