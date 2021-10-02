<?php

namespace App\Traits;

use Illuminate\Http\Response;

/**
 * Trait ApiResponse
 */
trait ApiResponse
{
    /**
     * Build a success response
     * @param string|array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $data,
        ], $code);
    }

    /**
     * Build a error response
     * @param string|array $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, int $code)
    {
        return response()->json([
            'error' => $message,
            'code' => $code
        ], $code);
    }
}
