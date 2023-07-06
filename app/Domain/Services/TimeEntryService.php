<?php

namespace App\Domain\Services;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Domain\Models\TimeEntry\TimeEntryRepository;
use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

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

    public function createTimeEntries(TrackerEnum $trackerEnum, Collection $timeEntries, \DateTime $scrapeDate) {
        $service = $trackerEnum->getService();

        foreach($this->timeEntriesGenerator($timeEntries) as $timeEntry) {
            $this->repository->updateOrCreate(
                'tracker_time_entry_id',
                $timeEntry[$trackerEnum->getTrackerIdKey(TimeEntry::class)],
                $service->mapTimeEntry($timeEntry, $scrapeDate),
            );
        }

        $this->repository->deleteEarlierScraped($scrapeDate);

        // TODO: add notification informing that time entries scrape has been finished
    }
}
