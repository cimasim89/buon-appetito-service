<?php

namespace App\Activity\Application\DTO;

class ModifyActivityRequest
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;

    public function __construct(?string $name, ?string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public static function create(array $data): ModifyActivityRequest
    {
        return new ModifyActivityRequest(
            $data["name"] ?? null,
            $data["description"] ?? null
        );
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}
