<?php

namespace App\Aggregate\Infrastructure\Controller;

use App\Aggregate\Application\AggregateActivityService;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/public/aggregate/activities")
 */
class AggregateActivityController
{
    /**
     * @Route("/{activityId}", name="get_aggregate_activity", methods={"GET"})
     */
    public function deleteItem(
        string $activityId,
        AggregateActivityService $aggregateActivityService
    ): JsonResponse {
        try {
            $response = $aggregateActivityService->getAggregateActivity($activityId);
            return new JsonResponse($response, 200);
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }
}
