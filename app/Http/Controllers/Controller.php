<?php

namespace App\Http\Controllers;

use App\Http\JsonResponse;

class Controller
{
    protected function json(mixed $data = null, int $status = 200): JsonResponse
    {
        return JsonResponse::make($data, $status);
    }

    protected function ok(mixed $data = null): JsonResponse
    {
        return $this->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    protected function created(mixed $data = null): JsonResponse
    {
        return $this->json([
            'success' => true,
            'data' => $data
        ], 201);
    }

    protected function error(string $message, int $status = 400): JsonResponse
    {
        return $this->json([
            'success' => false,
            'message' => $message
        ], $status);
    }
}