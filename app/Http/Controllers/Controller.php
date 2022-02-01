<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*protected function response(string $message, array $response, int $status): JsonResponse {
        return response()->json([
            $message => $response
        ], $status);
    }*/

    /*protected function response(array $response, int $status): JsonResponse {
        return response()->json($response, $status);
    }*/
}
