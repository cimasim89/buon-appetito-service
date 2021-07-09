<?php

namespace App\Activity\Application;

use App\Activity\Application\DTO\ActivityResponse;
use App\Activity\Application\DTO\GetActivityRequest;
use App\Activity\Domain\Exceptions\ActivityNotFoundException;
use App\Activity\Domain\Repository\ActivityRepository;

class QueryActivityService
{
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    /**
     * @throws ActivityNotFoundException
     */
    public function getActivity(GetActivityRequest $activityFindRequest): ActivityResponse
    {
        $activity = $this->activityRepository->getActivityByEmail($activityFindRequest->getEmail());
        return ActivityResponse::createFromActivity($activity);
    }

    /**
     * @throws ActivityNotFoundException
     */
    public function getActivityById(string $activityId): ActivityResponse
    {
        $activity = $this->activityRepository->getActivityById($activityId);
        return ActivityResponse::createFromActivity($activity);
    }
}
