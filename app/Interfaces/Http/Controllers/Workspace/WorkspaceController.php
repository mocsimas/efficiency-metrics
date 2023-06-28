<?php

namespace App\Interfaces\Http\Controllers\Workspace;

use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Base\ResourceController;

class WorkspaceController extends ResourceController
{
    public function __construct(
        protected readonly WorkspaceRepository $repository,
    ) {}
}
