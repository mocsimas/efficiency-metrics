<?php

namespace App\Interfaces\Http\Jobs;

use App\Domain\Services\TimeEntryService;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScrapeTimeEntries implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly TrackerEnum $trackerEnum,
        private readonly Collection $timeEntries,
    ) {}

    public function handle(TimeEntryService $service): void
    {
        $service->createTimeEntries($this->trackerEnum, $this->timeEntries);
    }
}
