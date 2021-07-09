<?php

namespace App\Item\Application;

use App\Item\Application\DTO\DeleteItemResponse;
use App\Item\Domain\Repository\ItemRepository;

class DeleteItemService
{
    private $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function deleteItem($itemId): DeleteItemResponse
    {
        $this->itemRepository->deleteItem($itemId);
        return DeleteItemResponse::create(true);
    }
}
