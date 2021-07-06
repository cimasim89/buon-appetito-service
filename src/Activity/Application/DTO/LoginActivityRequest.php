<?php

namespace App\Activity\Application\DTO;

class LoginActivityRequest
{
    /**
     * @var string
     */
    private $email;

    private function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param array $data
     * @return LoginActivityRequest
     */
    public static function create(array $data): LoginActivityRequest
    {
        return new LoginActivityRequest($data["email"]);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
