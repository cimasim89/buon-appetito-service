<?php

namespace App\Section\Application\DTO;

class ModifySectionRequest
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var int
     */
    public $sequence;

    public function __construct(?string $name, ?int $sequence)
    {
        $this->name = $name;
        $this->sequence = $sequence;
    }

    public static function create(array $data): ModifySectionRequest
    {
        return new ModifySectionRequest(
            $data["name"] ?? null,
            $data["sequence"] ?? null
        );
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}
