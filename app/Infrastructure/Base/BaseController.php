<?php

namespace App\Infrastructure\Base;

use App\Infrastructure\Contracts\ResourceContract;
use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

abstract class BaseController extends Controller
{
    protected function response($data): JsonResponse {
        $transformed = null;

        if($data instanceof ResourceContract)
            $transformed = $data->transform();
        else if($data instanceof Collection && $data->isNotEmpty() && $data->first() instanceof ResourceContract)
            $transformed = ($data->first()::class)::collection($data);

        return response()->json([
            'status' => 'success',
            'data' => $transformed ?: $data,
        ], 200);
    }

    protected function error(string $error, array $errors = [], int|string $code = 500, \Exception $exception = null): JsonResponse {
        if($exception instanceof ValidationException)
            $code = 422;

        if(!array_key_exists($code, Response::$statusTexts)) {
            if(config('app.debug') === true && config('app.env') !== 'testing')
                dd($error, $errors, $code);

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

    public function index() {
        try {
            $workspaces = $this->repository->index();

            return $this->response($workspaces);
        }catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }
}
