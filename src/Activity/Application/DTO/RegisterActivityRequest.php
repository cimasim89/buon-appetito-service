<?php

namespace App\Activity\Application\DTO;

class RegisterActivityRequest
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;

    private function __construct(string $name, string $description, string $email, string $password)
    {
        $this->name = $name;
        $this->description = $description;
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(array $registerActivityData): RegisterActivityRequest
    {

        return new RegisterActivityRequest(
            $registerActivityData["name"],
            $registerActivityData["description"],
            $registerActivityData["email"],
            $registerActivityData["password"]
        );
    }
}
