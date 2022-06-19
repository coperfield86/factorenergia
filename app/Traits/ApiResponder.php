<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponder
{
    public function successResponse($data = null, $api_code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(
            [
                "data" => $data
            ],
            $api_code);
    }

    public function errorResponse($error = '', $api_code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json(["error" => $error], $api_code);
    }
}
