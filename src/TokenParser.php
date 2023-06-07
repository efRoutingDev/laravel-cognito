<?php

namespace Efrouting\LaravelCognito;

use Efrouting\LaravelCognito\Exceptions\InvalidTokenException;
use Efrouting\LaravelCognito\Singletons\CognitoClientSingleton;
use Illuminate\Http\Request;

class TokenParser
{
    private $request;
    protected $header = 'authorization';
    protected $prefix = 'bearer';

    public function __construct(Request $request)
    {
        $this->request = $request;
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

        return $token;
    }
}