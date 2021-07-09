<?php

namespace App\Section\Application;

use App\Section\Application\DTO\ModifySectionRequest;
use App\Section\Application\DTO\ModifySectionResponse;
use App\Section\Domain\Repository\SectionRepository;

class ModifySectionService
{
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    public function updateSection(string $sectionId, ModifySectionRequest $modifySectionRequest): ModifySectionResponse
    {
        $section = $this->sectionRepository->modifySection($sectionId, $modifySectionRequest->toArray());
        return ModifySectionResponse::createFromSection($section);
    }
}
