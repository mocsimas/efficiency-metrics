<?php

namespace App\Domain\Models\Project;

use App\Infrastructure\Base\ResourceRepository;
use App\Infrastructure\Traits\Repository\HasImportDateTrait;
use App\Infrastructure\Traits\Repository\HasTrackerTrait;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository extends ResourceRepository
{
    use HasTrackerTrait, HasImportDateTrait;

    public function __construct(
        protected readonly Project $model,
    ) {}

    protected static function getArgs(): array {
        return [new Project()];
    }
}
