<?php

namespace App\Activity\Application\DTO;

class GetActivityRequest
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
     * @param string $email
     * @return GetActivityRequest
     */
    public static function create(string $email): GetActivityRequest
    {
        return new GetActivityRequest($email);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
