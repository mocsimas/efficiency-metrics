<?php

namespace App\Interfaces\Http\Controllers\Task;

use App\Domain\Models\Task\TaskRepository;
use App\Infrastructure\Base\ResourceController;
use App\Infrastructure\Requests\Task\TaskCreateRequest;
use App\Infrastructure\Requests\Task\TaskUpdateRequest;
use Illuminate\Http\JsonResponse;

class TaskController extends ResourceController
{
    public function __construct(
        protected readonly TaskRepository $repository,
    ) {}

    public function getCreateRequest(): string {
        return TaskCreateRequest::class;
    }

    public function getUpdateRequest(): string {
        return TaskUpdateRequest::class;
    }
}
