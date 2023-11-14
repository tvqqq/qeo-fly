<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class ApiBaseController extends Controller
{
    /**
     * @param array|Collection $data
     * @return JsonResponse
     */
    public function returnSuccess($data = []): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function returnFail(string $message = ''): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message ?? 'Something went wrong'
        ]);
    }
}
