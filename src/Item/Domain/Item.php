<?php

namespace App\Item\Domain;

class Item
{
    private $id;
    private $name;
    private $price;
    private $sectionId;

    private function __construct(string $id, string $name, int $price, string $sectionId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->sectionId = $sectionId;
    }

    public static function create(
        string $id,
        string $name,
        int $price,
        string $sectionId
    ): Item {
        return new Item($id, $name, $price, $sectionId);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
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
    public function getSectionId(): string
    {
        return $this->sectionId;
    }
}
