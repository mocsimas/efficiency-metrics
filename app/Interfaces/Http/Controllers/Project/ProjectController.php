<?php

namespace App\Interfaces\Http\Controllers\Project;

use App\Domain\Models\Project\Project;
use App\Domain\Models\Project\ProjectRepository;
use App\Infrastructure\Base\ResourceController;
use App\Infrastructure\Requests\Project\ProjectCreateRequest;
use App\Infrastructure\Requests\Project\ProjectUpdateRequest;
use Illuminate\Http\JsonResponse;

class ProjectController extends ResourceController
{
    public function __construct(
        protected readonly ProjectRepository $repository,
    ) {}

    public function getCreateRequest(): string {
        return ProjectCreateRequest::class;
    }

    public function getUpdateRequest(): string {
        return ProjectUpdateRequest::class;
    }

    public function tasks(Project $project): JsonResponse {
        try {
            $tasks = $project->tasks;

            return $this->response($tasks);
        }catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }
}
