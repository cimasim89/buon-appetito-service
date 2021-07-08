<?php

namespace App\Activity\Application;

use App\Activity\Application\DTO\ActivityResponse;
use App\Activity\Application\DTO\GetActivityRequest;
use App\Activity\Domain\Exceptions\ActivityNotFoundException;
use App\Activity\Domain\Repository\ActivityRepository;
use App\Services\UuidService;

class AuthenticatedActivityService
{
    private $activityRepository;
    private $uuidService;

    public function __construct(ActivityRepository $activityRepository, UuidService $uuidService)
    {
        $this->activityRepository = $activityRepository;
        $this->uuidService = $uuidService;
    }

    /**
     * @throws ActivityNotFoundException
     */
    public function getActivity(GetActivityRequest $activityFindRequest): ActivityResponse
    {
        $activity = $this->activityRepository->getActivityByEmail($activityFindRequest->getEmail());
        return ActivityResponse::createFromActivity($activity);
    }
}
