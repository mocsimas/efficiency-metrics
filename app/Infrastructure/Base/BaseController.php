<?php

namespace App\Infrastructure\Base;

use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

abstract class BaseController extends Controller
{
//    protected function response(array|JsonResource $data): JsonResponse {
    protected function response( $data): JsonResponse {
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    protected function error(string $error, array $errors = [], int|string $code = 500): JsonResponse {
        if(!array_key_exists($code, Response::$statusTexts)) {
            if(config('app.debug') === true && config('app.env') !== 'testing')
                dd($error, $errors);

            $error = 'Server error.';
            $errors = [];
            $code = 500;
        }

        return response()->json([
            'status' => 'error',
            'message' => $error,
            'errors' => $errors,
        ], $code);
    }
}
