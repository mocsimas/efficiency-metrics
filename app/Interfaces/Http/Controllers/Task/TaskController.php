<?php

namespace App\Interfaces\Http\Controllers\Task;

use App\Domain\Models\Task\TaskRepository;
use App\Infrastructure\Base\ResourceController;
use Illuminate\Http\JsonResponse;

class TaskController extends ResourceController
{
    public function __construct(
        protected readonly TaskRepository $repository,
    ) {}
}
