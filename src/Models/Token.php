<?php

namespace Efrouting\LaravelCognito\Models;

use Aws\Result;

class Token
{
    protected $accessToken;
    protected $refreshToken;
    protected $attributes;

    public function __construct(Result $result, string $accessToken = "", string $refreshToken = "")
    {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->attributes = $result->toArray();
    }

    public function Get(string $key)
    {
        return $this->attributes[$key];
    }

    public function GetUsername() : string
    {
        return $this->attributes['sub'];
    }
}

