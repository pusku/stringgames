<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\JsonResponse;

class Helper
{
    public static function returnMessage($response, $code): JsonResponse
    {
        return new JsonResponse($response, $code);
    }

    public static function ResponseProcessor($success, $message = "Something went wrong!", $data = [], $errors = []): array
    {
        return [
            "success" => $success,
            "message" => $message,
            "data" => $data,
            "errors" => $errors
        ];
    }

}