<?php

namespace App\Item\Domain\Repository;

use App\Item\Domain\Item;

interface ItemRepository
{
    public function deleteItem(string $itemId);
    public function deleteItemsBySectionId(string $sectionId);
    public function findAll();
    public function findBySectionId(string $sectionId): array;
    public function modifyItem(string $itemId, array $data): Item;
    public function saveItem(Item $item): Item;
}
