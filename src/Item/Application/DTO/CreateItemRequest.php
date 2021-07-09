<?php

namespace App\Item\Application\DTO;

class CreateItemRequest
{

    /**
     * @var string
     */
    public $name;
    /**
     * @var int
     */
    public $price;
    /**
     * @var string
     */
    public $sectionId;

    public function __construct(string $name, int $price, string $sectionId)
    {
        $this->name = $name;
        $this->price = $price;
        $this->sectionId = $sectionId;
    }

    public static function create(array $data): CreateItemRequest
    {
        return new CreateItemRequest(
            $data["name"],
            $data["price"],
            $data["sectionId"]
        );
    }
}
