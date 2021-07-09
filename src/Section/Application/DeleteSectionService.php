<?php

namespace App\Section\Application;

use App\Item\Domain\Repository\ItemRepository;
use App\Section\Application\DTO\DeleteSectionResponse;
use App\Section\Domain\Repository\SectionRepository;

class DeleteSectionService
{
    private $itemRepository;
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepository, ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->sectionRepository = $sectionRepository;
    }

    public function deleteSection($sectionId): DeleteSectionResponse
    {
        $this->sectionRepository->deleteSection($sectionId);
        $this->itemRepository->deleteItemsBySectionId($sectionId);
        return DeleteSectionResponse::create(true);
    }
}
