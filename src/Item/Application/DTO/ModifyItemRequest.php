<?php

namespace App\Item\Application\DTO;

class ModifyItemRequest
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var int
     */
    public $price;

    public function __construct(string $name, int $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public static function create(array $data): ModifyItemRequest
    {
        return new ModifyItemRequest(
            $data["name"],
            $data["price"]
        );
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}
