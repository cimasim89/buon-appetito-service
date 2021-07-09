<?php

namespace App\Aggregate\Application;

use App\Activity\Application\QueryActivityService;
use App\Item\Application\DTO\GetItemBySectionIdQuery;
use App\Item\Application\QueryItemService;
use App\Section\Application\DTO\GetSectionByActivityIdQuery;
use App\Section\Application\QuerySectionService;

class AggregateActivityService
{
    private $queryActivityService;
    private $querySectionService;
    private $queryItemService;

    public function __construct(
        QueryActivityService $queryActivityService,
        QuerySectionService $querySectionService,
        QueryItemService $queryItemService
    ) {
        $this->queryActivityService = $queryActivityService;
        $this->querySectionService = $querySectionService;
        $this->queryItemService = $queryItemService;
    }

    public function getAggregateActivity(string $activityId): array
    {
        $activity = $this->queryActivityService->getActivityById($activityId);
        $sections = $this->getActivitySectionWithItemsByActivityId($activityId);
        $activity->sections = $sections;
        return (array) $activity;
    }

    private function getActivitySectionWithItemsByActivityId(string $activityId): array
    {
        $sections = $this->querySectionService->getSectionByActivityId(
            GetSectionByActivityIdQuery::create($activityId)
        );
        return array_map(function ($section) {
            $items = $this->queryItemService->getItemBySectionId(
                GetItemBySectionIdQuery::create($section->id)
            );
            $section->items = $items;
            return (array) $section;
        }, $sections);
    }
}
