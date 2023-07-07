<?php

namespace App\Domain\Models\Workspace;

use App\Infrastructure\Base\ResourceRepository;
use App\Infrastructure\Traits\Repository\HasImportDateTrait;
use App\Infrastructure\Traits\Repository\HasTrackerTrait;

class WorkspaceRepository extends ResourceRepository
{
    use HasTrackerTrait, HasImportDateTrait;

    public function __construct(
        protected readonly Workspace $model,
    ) {}

    protected static function getArgs(): array {
        return [new Workspace()];
    }
}
