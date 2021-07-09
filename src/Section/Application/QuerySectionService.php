<?php

namespace App\Section\Application;

use App\Section\Application\DTO\GetSectionByActivityIdQuery;
use App\Section\Application\DTO\GetSectionByActivityIdResponse;
use App\Section\Domain\Repository\SectionRepository;

class QuerySectionService
{
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepository)
    {
        $this->sectionRepository = $sectionRepository;
    }

    public function getSectionByActivityId(GetSectionByActivityIdQuery $getSectionByActivityIdQuery): array
    {
        return array_map(
            function ($section) {
                return GetSectionByActivityIdResponse::createFromSection($section);
            },
            $this->sectionRepository->findByActivityId($getSectionByActivityIdQuery->activityId)
        );
    }
}
