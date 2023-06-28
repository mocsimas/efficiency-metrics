<?php

namespace App\Domain\Services;

use App\Domain\Models\Workspace\Workspace;
use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

class WorkspaceService
{
    private readonly WorkspaceRepository $repository;

    public function __construct() {
        $this->repository = WorkspaceRepository::getInstance();
    }

    private function workspacesGenerator(Collection $workspaces): \Generator {
        foreach($workspaces as $workspace)
            yield (array) $workspace;
    }

    public function createWorkspaces(TrackerEnum $trackerEnum, Collection $workspaces) {
        $service = $trackerEnum->getService();

        foreach($this->workspacesGenerator($workspaces) as $workspace)
            $this->repository->updateOrCreate(
                'tracker_workspace_id',
                $workspace[$trackerEnum->getTrackerIdKey(Workspace::class)],
                $service->mapWorkspace($workspace)
            );

        // TODO: add notification informing that workspaces scrape has been finished
    }
}
