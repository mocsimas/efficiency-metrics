<?php

namespace App\Domain\Services\Model;

use App\Domain\Models\Project\Project;
use App\Domain\Models\Project\ProjectRepository;
use App\Domain\Services\Abstract\ModelService;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

class ProjectService extends ModelService
{
    private readonly ProjectRepository $repository;

    public function __construct() {
        $this->repository = ProjectRepository::getInstance();
    }

    public function create(TrackerEnum $trackerEnum, Collection $collection, \DateTime $importDate): void {
        $service = $trackerEnum->getService();

        foreach($this->generator($collection) as $project)
            $this->repository->updateOrCreate(
                'tracker_id',
                $project[$trackerEnum->getTrackerIdKey(Project::class)],
                $service->mapProject($project, $importDate),
            );

        $this->repository->deleteEarlierImported($importDate);
    }
}
