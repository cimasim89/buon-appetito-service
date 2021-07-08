<?php

namespace App\Activity\Infrastructure\Controller;

use App\Activity\Application\AuthenticatedActivityService;
use App\Activity\Application\DTO\GetActivityRequest;
use App\Activity\Domain\Exceptions\ActivityNotFoundException;
use Exception;
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
     * @Route("/me", name="acitivity_me", methods={"GET"})
     */
    public function getMineActivity(AuthenticatedActivityService $authenticatedActivityService): JsonResponse
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
}
