<?php

namespace Efrouting\LaravelCognito;
use Efrouting\LaravelCognito\Exceptions\InvalidTokenException;
use Efrouting\LaravelCognito\Exceptions\NoTokenException;
use Efrouting\LaravelCognito\Singletons\CognitoClientSingleton;

class AWSCognito
{
    private $parser;
    private $cognitoClient;

    protected $accessToken;

    public function __construct(CognitoClientSingleton $cognitoClient, TokenParser $parser)
    {
        $this->parser = $parser;
        $this->cognitoClient = $cognitoClient;
    }

    protected function getUser() : \Aws\Result
    {
        if(empty($this->accessToken)) {
            throw new NoTokenException();
        }

        $user = null;
        try {
            $user = $this->cognitoClient->getClient()->getUser([
                'AccessToken' => $this->accessToken
            ]);
        }
        catch (\Exception $e) {
            throw new InvalidTokenException($e->getMessage());
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

        $this->parser->decode($token);

        $this->accessToken = $token;

        return $this->getUser();
    }
}
