<?php

namespace App\Item\Infrastructure\Controller;

use App\Item\Application\CreateItemService;
use App\Item\Application\DeleteItemService;
use App\Item\Application\DTO\CreateItemRequest;
use App\Item\Application\DTO\ModifyItemRequest;
use App\Item\Application\ModifyItemService;
use App\Services\RequestBodyParser;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/items")
 */
class ItemController
{
    /**
     * @Route("", name="item_create", methods={"POST"})
     */
    public function createItem(
        Request $request,
        CreateItemService $createItemService,
        RequestBodyParser $requestBodyParser
    ): JsonResponse {
        try {
            $response = $createItemService->addItem(
                CreateItemRequest::create($requestBodyParser->parseBody($request))
            );
            return new JsonResponse($response, 200);
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }

    /**
     * @Route("/{itemId}", name="item_delete", methods={"DELETE"})
     */
    public function deleteItem(
        string $itemId,
        DeleteItemService $deleteItemService
    ): JsonResponse {
        try {
            $response = $deleteItemService->deleteItem($itemId);
            return new JsonResponse($response, 200);
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }

    /**
     * @Route("/{itemId}", name="item_update", methods={"PUT"})
     */
    public function updateItem(
        string $itemId,
        Request $request,
        ModifyItemService $modifyItemService,
        RequestBodyParser $requestBodyParser
    ): JsonResponse {
        try {
            $response = $modifyItemService->updateItem(
                $itemId,
                ModifyItemRequest::create($requestBodyParser->parseBody(
                    $request
                ))
            );
            return new JsonResponse($response, 200);
        } catch (Exception $error) {
            throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, $error->getMessage());
        }
    }
}
