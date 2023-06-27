<?php

namespace App\Domain\Services;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Domain\Models\TimeEntry\TimeEntryRepository;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Collection;

class TimeEntryService
{
    private readonly TimeEntryRepository $repository;

    public function __construct() {
        $this->repository = TimeEntryRepository::getInstance();
    }

    private function timeEntriesGenerator(Collection $timeEntries): \Generator {
        foreach($timeEntries as $timeEntry)
            yield (array) $timeEntry;
    }

    public function createTimeEntries(TrackerEnum $trackerEnum, Collection $timeEntries) {
        $service = $trackerEnum->getService();

        foreach($this->timeEntriesGenerator($timeEntries) as $timeEntry)
            $this->repository->updateOrCreate(
                'tracker_time_entry_id',
                $timeEntry[$trackerEnum->getTrackerIdKey(TimeEntry::class)],
                $service->mapWorkspace($timeEntry),
            );

        // TODO: add notification informing that time entries scrape has been finished
    }
}
