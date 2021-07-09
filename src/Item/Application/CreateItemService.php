<?php

namespace App\Item\Application;

use App\Item\Application\DTO\CreateItemRequest;
use App\Item\Application\DTO\CreateItemResponse;
use App\Item\Domain\Repository\ItemRepository;
use App\Item\Domain\Item;
use App\Services\UuidService;

class CreateItemService
{
    private $itemRepository;
    private $uuidService;

    public function __construct(ItemRepository $itemRepository, UuidService $uuidService)
    {
        $this->itemRepository = $itemRepository;
        $this->uuidService = $uuidService;
    }

    public function addItem(CreateItemRequest $createItemRequest): CreateItemResponse
    {
        $item = Item::create(
            $this->uuidService->generateUuid(),
            $createItemRequest->name,
            $createItemRequest->price,
            $createItemRequest->sectionId
        );
        $this->itemRepository->saveItem($item);
        return CreateItemResponse::createFromItem($item);
    }
}
