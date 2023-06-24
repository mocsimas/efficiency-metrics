<?php

namespace App\Domain\Services;

use App\Domain\Models\Tracker\Tracker;
use App\Infrastructure\Enums\TrackerEnum;

class TrackerService
{
    public function getTracker(TrackerEnum $enum): Tracker {
        return Tracker::first();
    }

    public function getTrackerApiKey(TrackerEnum $enum): ?string {
        return $this->getTracker($enum)->key;
    }
}
