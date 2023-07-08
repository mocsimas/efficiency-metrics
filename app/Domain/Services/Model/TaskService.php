<?php

namespace App\Domain\Services\Model;

use App\Domain\Models\Project\Project;
use App\Domain\Models\Project\ProjectRepository;
use App\Domain\Models\Task\TaskRepository;
use App\Domain\Services\Abstract\ModelService;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

class TaskService extends ModelService
{
    private readonly TaskRepository $repository;

    public function __construct() {
        $this->repository = TaskRepository::getInstance();
    }

    public function create(TrackerEnum $trackerEnum, Collection $collection, \DateTime $importDate): void {
        $service = $trackerEnum->getService();

        foreach($this->generator($collection) as $project)
            $this->repository->updateOrCreate(
                'tracker_id',
                $project[$trackerEnum->getTrackerIdKey(Project::class)],
                $service->mapTask($project, $importDate),
            );

        $this->repository->deleteEarlierImported($importDate);
    }
}
