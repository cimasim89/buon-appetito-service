<?php

namespace App\Section\Infrastructure\Controller;

use App\Section\Application\CreateSectionService;
use App\Section\Application\DeleteSectionService;
use App\Section\Application\DTO\CreateSectionRequest;
use App\Section\Application\DTO\ModifySectionRequest;
use App\Section\Application\ModifySectionService;
use App\Services\RequestBodyParser;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/sections")
 */
class SectionController
{
    /**
     * @Route("", name="section_create", methods={"POST"})
     */
    public function createSection(
        Request $request,
        CreateSectionService $createSectionService,
        RequestBodyParser $requestBodyParser
    ): JsonResponse {
        try {
            $response = $createSectionService->addSection(
                CreateSectionRequest::create($requestBodyParser->parseBody($request))
            );
            return new JsonResponse($response, 200);
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }

    /**
     * @Route("/{sectionId}", name="section_delete", methods={"DELETE"})
     */
    public function deleteSection(
        string $sectionId,
        DeleteSectionService $deleteSectionService
    ): JsonResponse {
        try {
            $response = $deleteSectionService->deleteSection($sectionId);
            return new JsonResponse($response, 200);
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }

    /**
     * @Route("/{sectionId}", name="section_update", methods={"PUT"})
     */
    public function updateSection(
        string $sectionId,
        Request $request,
        ModifySectionService $modifySectionService,
        RequestBodyParser $requestBodyParser
    ): JsonResponse {
        try {
            $response = $modifySectionService->updateSection(
                $sectionId,
                ModifySectionRequest::create($requestBodyParser->parseBody(
                    $request
                ))
            );
            return new JsonResponse($response, 200);
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }
}
