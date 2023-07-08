<?php

namespace App\Domain\Services\Model;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Domain\Models\TimeEntry\TimeEntryRepository;
use App\Domain\Services\Abstract\ModelService;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

class TimeEntryService extends ModelService
{
    private readonly TimeEntryRepository $repository;

    public function __construct() {
        $this->repository = TimeEntryRepository::getInstance();
    }

    public function create(TrackerEnum $trackerEnum, Collection $collection, \DateTime $importDate): void {
        $service = $trackerEnum->getService();

        foreach($this->generator($collection) as $timeEntry)
            $this->repository->updateOrCreate(
                'tracker_id',
                $timeEntry[$trackerEnum->getTrackerIdKey(TimeEntry::class)],
                $service->mapTimeEntry($timeEntry, $importDate),
            );

        $this->repository->deleteEarlierImported($importDate);
    }
}
