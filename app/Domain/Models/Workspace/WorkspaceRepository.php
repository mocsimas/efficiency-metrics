<?php

namespace App\Domain\Models\Workspace;

use App\Infrastructure\Base\ResourceRepository;

class WorkspaceRepository extends ResourceRepository
{
    public function __construct(
        protected readonly Workspace $model,
    ) {}
}
