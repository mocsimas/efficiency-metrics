<?php

namespace App\Interfaces\Http\Controllers\Workspace;

use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Base\ResourceController;
use App\Infrastructure\Requests\Workspace\WorkspaceCreateRequest;
use App\Infrastructure\Requests\Workspace\WorkspaceUpdateRequest;

class WorkspaceController extends ResourceController
{
    public function __construct(
        protected readonly WorkspaceRepository $repository,
    ) {}

    public function getCreateRequest(): string {
        return WorkspaceCreateRequest::class;
    }

    public function getUpdateRequest(): string {
        return WorkspaceUpdateRequest::class;
    }
}
