<?php

namespace App\Activity\Domain;

class Activity
{
    private $id;
    private $name;
    private $description;
    private $email;
    private $password;

    private function __construct(string $id, string $name, string $description, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(
        string $id,
        string $name,
        string $description,
        string $email,
        string $password
    ): Activity {
        return new Activity($id, $name, $description, $email, $password);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
