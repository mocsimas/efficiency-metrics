<?php

namespace App\Domain\Services;

use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

class WorkspaceService
{
    public function __construct(
        private readonly WorkspaceRepository $repository,
    ) {}

    private function workspacesGenerator(Collection $workspaces): \Generator {
        foreach($workspaces as $workspace)
            yield (array) $workspace;
    }

    public function createWorkspaces(TrackerEnum $trackerEnum, Collection $workspaces) {
        $service = $trackerEnum->getService();

        foreach($this->workspacesGenerator($workspaces) as $workspace) {
            if(!$this->repository->find('tracker_workspace_id', $workspace[$trackerEnum->getTrackerIdKey()]))
                $this->repository->create($service->mapWorkspace($workspace));
        }

        // TODO: add notification informing that workspaces scrape has been finished
    }
}
