<?php

namespace App\Infrastructure\Base;

use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class ResourceController extends BaseController
{
    public function index(): JsonResponse {
        try {
            $workspaces = $this->repository->index();

            return $this->response($workspaces);
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }

    public function create(Request $request): JsonResponse {
        try {
            $payload = $this->validator($request, 'create');

            $workspaces = $this->repository->create($payload);

            return $this->response($workspaces);
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }

    public function update(Request $request): JsonResponse {
        try {
            $payload = $this->validator($request, 'update');

            $workspaces = $this->repository->update($payload);

            return $this->response($workspaces);
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }
}
