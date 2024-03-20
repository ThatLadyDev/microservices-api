<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /** @var array $structure */
    private static array $structure;

    /** @var int $statusCode */
    private static int $statusCode;

    /**
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return ApiResponse
     */
    public static function success(string $message = '', array $data = [], int $statusCode = 200): ApiResponse
    {
        self::$statusCode = $statusCode;
        self::$structure = self::responseStructure(true, $message, $data);
        return new self;
    }

    public function toJson()
    {
        return response()->json($this::$structure, $this::$statusCode);
    }

    public function toArray()
    {
        return $this::$structure;
    }

    // @codeCoverageIgnoreStart
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
    // @codeCoverageIgnoreEnd

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
