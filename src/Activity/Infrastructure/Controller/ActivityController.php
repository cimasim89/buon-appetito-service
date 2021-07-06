<?php

namespace App\Activity\Infrastructure\Controller;

use App\Activity\Application\CreateActivityService;
use App\Activity\Application\DTO\RegisterActivityRequest;
use App\Services\RequestBodyParser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ActivityController
{

    /**
     * @Route("/activities", name="acitivity_create", methods={"POST"})
     */
    public function getAllActivities(
        Request $request,
        CreateActivityService $createActivityService,
        RequestBodyParser $requestBodyParser
    ): JsonResponse {
        $registerActivityRequest = RegisterActivityRequest::create($requestBodyParser->parseBody($request));
        $activity = $createActivityService->registerActivity($registerActivityRequest);
        return new JsonResponse($activity, 201);
    }
}
