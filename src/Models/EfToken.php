<?php

namespace Efrouting\LaravelCognito\Models;

class EfToken
{
    //Composition over inheritance
    protected $tokenModel;

    public function __construct(Token $token)
    {
        $this->tokenModel = $token;
    }

    public function GetEmail() : string
    {
        return $this->tokenModel->Get('email');
    }

    public function GetGivenName() : string
    {
        return $this->tokenModel->Get('given_name');
    }

    public function GetFamilyName() : string
    {
        return $this->tokenModel->Get('family_name');
    }

    public function GetPhoneNumber() : string
    {
        return $this->tokenModel->Get('phone_number');
    }
}