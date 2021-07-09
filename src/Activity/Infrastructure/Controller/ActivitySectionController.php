<?php

namespace App\Activity\Infrastructure\Controller;

use App\Section\Application\DTO\GetSectionByActivityIdQuery;
use App\Section\Application\QuerySectionService;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/activities")
 */
class ActivitySectionController
{

    /**
     * @Route("/{activityId}/sections", name="get_activity_sections", methods={"GET","OPTIONS"})
     */
    public function getSectionsByActivityId(string $activityId, QuerySectionService $querySectionService): JsonResponse
    {
        try {
            $response = $querySectionService->getSectionByActivityId(GetSectionByActivityIdQuery::create($activityId));
            return new JsonResponse($response, 200);
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }
}
