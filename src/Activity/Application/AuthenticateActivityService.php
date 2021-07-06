<?php

namespace App\Activity\Application;

use App\Activity\Application\DTO\LoginActivityRequest;
use App\Activity\Application\DTO\LoginActivityResponse;
use App\Services\JWTService;

class AuthenticateActivityService
{
    private $JWTService;

    public function __construct(
        JWTService $JWTService
    ) {
        $this->JWTService = $JWTService;
    }

    public function activityLoginAction(
        LoginActivityRequest $loginActivityRequest
    ): LoginActivityResponse {
        $token = $this->JWTService->encode(
            ['email' => $loginActivityRequest->getEmail()]
        );
        return LoginActivityResponse::create($token);
    }
}
