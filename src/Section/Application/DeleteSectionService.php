<?php

namespace App\Section\Application;

use App\Section\Application\DTO\DeleteSectionResponse;
use App\Section\Domain\Repository\SectionRepository;

class DeleteSectionService
{
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    public function deleteSection($sectionId): DeleteSectionResponse
    {
        $this->sectionRepository->deleteSection($sectionId);
        return DeleteSectionResponse::create(true);
    }
}
