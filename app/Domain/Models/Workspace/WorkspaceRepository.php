<?php

namespace App\Domain\Models\Workspace;

use App\Domain\Services\ClockifyService;
use App\Infrastructure\Base\BaseRepository;
use App\Infrastructure\Base\ResourceRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class WorkspaceRepository extends ResourceRepository
{
    public function __construct(
        protected readonly Workspace $model,
    ) {}

    public function index(): Collection {
        return $this->getModelQueryBuilder()->all();
    }
}
