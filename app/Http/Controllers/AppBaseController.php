<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class AppBaseController
 *
 * Base controller for API responses.
 */
class AppBaseController extends Controller
{
    /**
     * Send a successful JSON response.
     *
     * @param array $result
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse(array $result, string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    /**
     * Send an error JSON response.
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, array $errorMessages = [], int $code = Response::HTTP_NOT_FOUND): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * Send a simple success message.
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendSuccess(string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
        ], $code);
    }
}
