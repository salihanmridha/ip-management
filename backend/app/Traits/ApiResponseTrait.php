<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Send a success response with optional data and status code.
     *
     * @param  string  $message
     * @param  array|null  $data
     * @param  int  $statusCode
     *
     * @return JsonResponse
     */
    public function successResponse(string $message, array $data = null, int $statusCode = 200)
    {
        return response()->json([
            'status'  => $statusCode,
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $statusCode);
    }

    /**
     * Send an error response with error message and status code.
     *
     * @param  string  $message
     * @param  int  $statusCode
     *
     * @return JsonResponse
     */
    public function errorResponse(string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'status'  => $statusCode,
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }
}
