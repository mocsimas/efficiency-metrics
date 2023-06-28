<?php

namespace App\Interfaces\Http\Controllers\Workspace;

use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Infrastructure\Base\BaseController;

class WorkspaceController extends BaseController
{
    public function __construct(
        protected readonly WorkspaceRepository $repository,
    ) {}
}
