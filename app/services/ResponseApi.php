<?php

namespace App\services;

trait ResponseApi
{
    public function successMessage(string $message = "", int $code = 200)
    {
        return response()->json(
            [
                'message' => $message,
                'errors' => (object)[],
                'data' => (object)[],
            ],
            $code
        );
    }

    public function errorMessage(array $errors, string $message = "", int $code = 422)
    {
        return response()->json(
            [
                'message' => $message,
                'errors' => $errors,
                'data' => (object)[],
            ],
            $code
        );
    }

    public function responseData(array $data, string $message = "", int $code = 200)
    {
        return response()->json(
            [
                'message' => $message,
                'errors' => (object)[],
                'data' => $data,
            ],
            $code
        );
    }
}
