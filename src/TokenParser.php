<?php

namespace Efrouting\LaravelCognito;

use CoderCat\JWKToPEM\JWKConverter;
use Efrouting\LaravelCognito\Exceptions\ConfigurationErrorException;
use Efrouting\LaravelCognito\Exceptions\InvalidTokenException;
use Efrouting\LaravelCognito\Singletons\CognitoClientSingleton;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class TokenParser
{
    private $request;
    private $client;

    protected $header = 'authorization';
    protected $prefix = 'bearer';

    public function __construct(CognitoClientSingleton $client, Request $request)
    {
        $this->request = $request;
        $this->client = $client;
    }

    public function decode($token)
    {
        $key = $this->client->getJwtKey();
        if(empty($key)) {
            throw new ConfigurationErrorException('Missing JWT key');
        }

        $converter = new JWKConverter();
        $pem = new Key($converter->toPEM($key), $key['alg']);

        try
        {
            return (array)JWT::decode($token, $pem);
        }
        catch(ExpiredException $e) {
            throw new ExpiredException();
        }
        catch(\Exception $e) {
            throw new InvalidTokenException($e->getMessage());
        }
    }

    public function parse()
    {
        $token = $this->request->header($this->header);
        if (empty($token)) {
            return null;
        }
        
        $token = trim($token);

        if (!str_starts_with(strtolower($token), $this->prefix)) {
            throw new InvalidTokenException('Invalid token prefix');
        }

        $token = str_ireplace($this->prefix, '', $token);
        $token = trim($token);

        return $token;
    }
}