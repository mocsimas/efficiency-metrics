<?php

namespace App\Interfaces\Http\Controllers\Workspace;

use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Infrastructure\Base\BaseController;

class WorkspaceController extends BaseController
{
    public function __construct(
        private readonly WorkspaceRepository $repository,
    ) {}

    public function index() {
        try {
            $workspaces = $this->repository->index();
            return $this->response($workspaces);
        }catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }
}
