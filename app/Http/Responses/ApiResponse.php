<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function success(string $message = '', array $data = [], int $statusCode = 200): JsonResponse
    {
        $data = self::responseStructure(true, $message, $data);
        return response()->json($data, $statusCode);
    }

    /**
     * @param string $message
     * @param int $statusCode
     * @param array $data
     * @return JsonResponse
     */
    public static function error(string $message = '', int $statusCode = 400, array $data = []): JsonResponse
    {
        $data = self::responseStructure(false, $message, $data);
        return response()->json($data, $statusCode);
    }

    /**
     * @param bool $success
     * @param string $message
     * @param array $data
     * @return array
     */
    private static function responseStructure(bool $success, string $message, array $data = []): array
    {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ];
    }
}
