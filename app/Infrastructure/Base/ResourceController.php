<?php

namespace App\Infrastructure\Base;

use App\Interfaces\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class ResourceController extends BaseController
{
    public function index(): JsonResponse {
        try {
            $workspaces = $this->repository->index();

            return $this->response($workspaces);
        }catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }
}
