<?php

namespace App\Item\Application\DTO;

use App\Item\Domain\Item;

class CreateItemResponse
{

    /**
     * @var string
     */
    public $id;
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

    public function __construct(string $id, string $name, int $price, string $sectionId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->sectionId = $sectionId;
    }

    public static function createFromItem(Item $item): CreateItemResponse
    {
        return new CreateItemResponse(
            $item->getId(),
            $item->getName(),
            $item->getPrice(),
            $item->getSectionId()
        );
    }
}
