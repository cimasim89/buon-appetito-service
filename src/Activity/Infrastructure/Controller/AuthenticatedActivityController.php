<?php

namespace App\Activity\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="acitivity_create", methods={"POST"})
 */
class AuthenticatedActivityController
{

    /**
     * @Route("/activities", name="acitivity_list", methods={"POST"})
     */
    public function getActivities(): JsonResponse
    {
        return new JsonResponse([], 201);
    }
}
