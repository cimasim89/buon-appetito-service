<?php

namespace App\Activity\Infrastructure\Controller;

use App\Activity\Application\DTO\ModifyActivityRequest;
use App\Activity\Application\ModifyActivityService;
use App\Activity\Application\QueryActivityService;
use App\Activity\Application\DTO\GetActivityRequest;
use App\Activity\Domain\Exceptions\ActivityNotFoundException;
use App\Services\RequestBodyParser;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/activities")
 */
class AuthenticatedActivityController extends AbstractController
{

    /**
     * @Route("/me", name="activity_me", methods={"GET","OPTIONS"})
     */
    public function getMineActivity(QueryActivityService $authenticatedActivityService): JsonResponse
    {
        try {
            $activityEmail = $this->getUser()->getUsername();
            $response = $authenticatedActivityService->getActivity(GetActivityRequest::create($activityEmail));
            return new JsonResponse($response, 200);
        } catch (ActivityNotFoundException $error) {
            throw new HttpException(Response::HTTP_NOT_FOUND, $error->getMessage());
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }

    /**
     * @Route("/{activityId}", name="activity_update", methods={"PUT"})
     */
    public function updateItem(
        string $activityId,
        Request $request,
        ModifyActivityService $modifyActivityService,
        RequestBodyParser $requestBodyParser
    ): JsonResponse {
        try {
            $response = $modifyActivityService->updateItem(
                $activityId,
                ModifyActivityRequest::create($requestBodyParser->parseBody(
                    $request
                ))
            );
            return new JsonResponse($response, 200);
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }
}
