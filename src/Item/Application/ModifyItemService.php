<?php

namespace App\Item\Application;

use App\Item\Application\DTO\ModifyItemRequest;
use App\Item\Application\DTO\ModifyItemResponse;
use App\Item\Domain\Repository\ItemRepository;

class ModifyItemService
{
    private $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function updateItem(string $itemId, ModifyItemRequest $modifyItemRequest): ModifyItemResponse
    {
        $item = $this->itemRepository->modifyItem($itemId, $modifyItemRequest->toArray());
        return ModifyItemResponse::createFromItem($item);
    }
}
