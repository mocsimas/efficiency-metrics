<?php

namespace App\Domain\Services;

use App\Domain\Models\TimeEntry\TimeEntryRepository;

class MetricsService
{
    public function monthHours(int $year, int $month): string {
        return TimeEntryRepository::getInstance()->monthHours($year, $month);
    }
}
