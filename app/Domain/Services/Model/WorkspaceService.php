<?php

namespace App\Domain\Services\Model;

use App\Domain\Models\Workspace\Workspace;
use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Domain\Services\Abstract\ModelService;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

class WorkspaceService extends ModelService
{
    private readonly WorkspaceRepository $repository;

    public function __construct() {
        $this->repository = WorkspaceRepository::getInstance();
    }

    public function create(TrackerEnum $trackerEnum, Collection $collection, \DateTime $importDate): void {
        $service = $trackerEnum->getService();

        foreach($this->generator($collection) as $workspace)
            $this->repository->updateOrCreate(
                'tracker_id',
                $workspace[$trackerEnum->getTrackerIdKey(Workspace::class)],
                $service->mapWorkspace($workspace, $importDate),
            );

        $this->repository->deleteEarlierImported($importDate);
    }
}
