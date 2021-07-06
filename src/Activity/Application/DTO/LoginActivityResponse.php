<?php

namespace App\Activity\Application\DTO;

class LoginActivityResponse
{
    /**
     * @var string
     */
    public $token;

    private function __construct(string $token)
    {
        $this->token = $token;
    }

    public static function create(string $token): LoginActivityResponse
    {
        return new LoginActivityResponse($token);
    }
}
