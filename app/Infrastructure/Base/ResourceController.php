<?php

namespace App\Infrastructure\Base;

use App\Infrastructure\Contracts\Request\CreateRequestContract;
use App\Infrastructure\Contracts\Request\UpdateRequestContract;
use Illuminate\Http\JsonResponse;

abstract class ResourceController extends BaseController
{
    abstract public function getCreateRequest(): string;

    abstract public function getUpdateRequest(): string;

    public function index(): JsonResponse {
        try {
            $workspaces = $this->repository->index();

            return $this->response($workspaces);
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }

    public function create(CreateRequestContract $request): JsonResponse {
        try {
            $models = $this->repository->create($request->validated());

            return $this->response($models);
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }

    public function update(UpdateRequestContract $request): JsonResponse {
        try {
            $models = $this->repository->update($request->validated());

            return $this->response($models);
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }
}
