<?php

namespace App\Section\Application;

use App\Section\Application\DTO\CreateSectionRequest;
use App\Section\Application\DTO\CreateSectionResponse;
use App\Section\Domain\Repository\SectionRepository;
use App\Section\Domain\Section;
use App\Services\UuidService;

class CreateSectionService
{
    private $sectionRepository;
    private $uuidService;

    public function __construct(SectionRepository $sectionRepository, UuidService $uuidService)
    {
        $this->sectionRepository = $sectionRepository;
        $this->uuidService = $uuidService;
    }

    public function addSection(CreateSectionRequest $createSectionRequest): CreateSectionResponse
    {
        $section = Section::create(
            $this->uuidService->generateUuid(),
            $createSectionRequest->name,
            $createSectionRequest->sequence,
            $createSectionRequest->activityId
        );
        $this->sectionRepository->saveSection($section);
        return CreateSectionResponse::createFromSection($section);
    }
}
