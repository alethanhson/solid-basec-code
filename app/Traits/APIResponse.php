<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HTTPStatus;

trait APIResponse
{
    public function responseSuccess(mixed $message = 'Success', int $status = HTTPStatus::HTTP_OK): JsonResponse
    {
        return Response::json([
            'message' => $message,
            'status_code' => $status,
        ], $status);
    }

    public function responseSuccessWithData(
        mixed $data,
        mixed $message = 'Success',
        int $status = HTTPStatus::HTTP_OK
    ): JsonResponse {
        return Response::json([
            'data' => $data,
            'message' => $message,
            'status_code' => $status,
        ], $status);
    }

    public function responseError(
        mixed $message = 'Error',
        int $status = HTTPStatus::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse {
        return Response::json([
            'message' => $message,
            'status_code' => $status,
        ], $status);
    }

    public function responseErrorWithData(
        mixed $errors,
        string $message = 'Error',
        int $status = HTTPStatus::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse {
        return Response::json([
            'errors' => $errors,
            'message' => $message,
            'status_code' => $status,
        ], $status);
    }

    /**
     * Format Json.
     *
     * @param string $className
     * @param string $item
     * @param mixed|null $other
     * @return object
     */
    public function formatJson(string $className, string $item, mixed $other = null): object
    {
        return new $className($item, $other);
    }
}
