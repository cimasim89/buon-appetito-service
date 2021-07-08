<?php

namespace App\Activity\Infrastructure\Controller;

use App\Activity\Application\AuthenticateActivityService;
use App\Activity\Application\CreateActivityService;
use App\Activity\Application\DTO\LoginActivityRequest;
use App\Activity\Application\DTO\RegisterActivityRequest;
use App\Services\RequestBodyParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/public")
 */
class PublicActivityController extends AbstractController
{

    /**
     * @Route("/activities/register", name="acitivity_create", methods={"POST"})
     */
    public function registerActivity(
        Request $request,
        CreateActivityService $createActivityService,
        RequestBodyParser $requestBodyParser
    ): JsonResponse {
        $registerActivityRequest = RegisterActivityRequest::create($requestBodyParser->parseBody($request));
        $activity = $createActivityService->registerActivity($registerActivityRequest);
        return new JsonResponse($activity, 201);
    }

    /**
     * @Route("/activities/login", name="acitivity_login", methods={"POST"})
     */
    public function loginActivity(
        Request $request,
        AuthenticateActivityService $authenticateActivityService,
        RequestBodyParser $requestBodyParser
    ): JsonResponse {
        $response = $authenticateActivityService->activityLoginAction(
            LoginActivityRequest::create($requestBodyParser->parseBody($request))
        );
        return new JsonResponse($response, 200);
    }
}
