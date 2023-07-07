<?php

namespace App\Domain\Services;

use App\Domain\Models\TimeEntry\TimeEntryRepository;

class TimeService
{
    public function secondsToDuration(int $seconds): string {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $remainingSeconds);
    }
}
