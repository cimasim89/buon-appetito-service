<?php

namespace App\Activity\Application;

use App\Activity\Application\DTO\ModifyActivityRequest;
use App\Activity\Application\DTO\ModifyActivityResponse;
use App\Activity\Domain\Repository\ActivityRepository;

class ModifyActivityService
{
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    public function updateItem(string $activityId, ModifyActivityRequest $modifyActivityRequest): ModifyActivityResponse
    {
        $activity = $this->activityRepository->modifyActivity($activityId, $modifyActivityRequest->toArray());
        return ModifyActivityResponse::createFromActivity($activity);
    }
}
