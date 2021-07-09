<?php

namespace App\Item\Application;

use App\Item\Application\DTO\GetItemBySectionIdQuery;
use App\Item\Application\DTO\GetItemBySectionIdResponse;
use App\Item\Domain\Repository\ItemRepository;

class QueryItemService
{
    private $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function getItemBySectionId(GetItemBySectionIdQuery $getItemBySectionIdQuery): array
    {
        return array_map(
            function ($item) {
                return GetItemBySectionIdResponse::createFromItem($item);
            },
            $this->itemRepository->findBySectionId($getItemBySectionIdQuery->sectionId)
        );
    }
}
