<?php

namespace App\Domain\Models\Task;

use App\Domain\Models\Project\Project;
use App\Infrastructure\Base\ResourceRepository;
use App\Infrastructure\Traits\Repository\HasImportDateTrait;
use App\Infrastructure\Traits\Repository\HasTrackerTrait;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository extends ResourceRepository
{
    use HasTrackerTrait, HasImportDateTrait;

    public function __construct(
        protected readonly Task $model,
    ) {}

    protected static function getArgs(): array {
        return [new Task()];
    }
}
