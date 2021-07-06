<?php

namespace App\Activity\Application;

use App\Activity\Application\DTO\RegisterActivityRequest;
use App\Activity\Application\DTO\RegisterActivityResponse;
use App\Activity\Domain\Activity;
use App\Activity\Domain\Repository\ActivityRepository;
use App\Services\UuidService;

class CreateActivityService
{
    private $activityRepository;
    private $uuidService;

    public function __construct(ActivityRepository $activityRepository, UuidService $uuidService)
    {
        $this->activityRepository = $activityRepository;
        $this->uuidService = $uuidService;
    }

    public function registerActivity(RegisterActivityRequest $registerActivityRequest): RegisterActivityResponse
    {
        $activity = Activity::create(
            $this->uuidService->generateUuid(),
            $registerActivityRequest->name,
            $registerActivityRequest->description,
            $registerActivityRequest->email,
            $registerActivityRequest->password
        );
        $this->activityRepository->saveActivity($activity);
        return RegisterActivityResponse::createFromActivity($activity);
    }
}
