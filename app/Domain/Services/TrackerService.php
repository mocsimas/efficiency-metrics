<?php

namespace App\Domain\Services;

use App\Domain\Models\Tracker\Tracker;
use App\Infrastructure\Enums\TrackerEnum;
use App\Interfaces\Http\Jobs\ScrapeWorkspaces;

class TrackerService
{
    public function getTracker(TrackerEnum $enum): ?Tracker {
        return Tracker::first();
    }

    public function getTrackerApiKey(TrackerEnum $enum): ?string {
        return config('app.env') === 'testing' ? $enum->getDefaultKey() : $this->getTracker($enum)?->key;
    }
}
