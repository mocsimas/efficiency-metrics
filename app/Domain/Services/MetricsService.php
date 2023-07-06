<?php

namespace App\Domain\Services;

use App\Domain\Models\TimeEntry\TimeEntryRepository;
use App\Domain\Models\Workspace\Workspace;

class MetricsService
{
    public function workspaceDuration(int $year, int $month, ?Workspace $workspace): string {
        return TimeEntryRepository::getInstance()->monthHours($year, $month, $workspace);
    }
}
