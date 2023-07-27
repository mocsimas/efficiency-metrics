<?php

namespace App\Domain\Services;

use App\Domain\Models\Estimate\Estimate;
use App\Domain\Models\TimeEntry\TimeEntryRepository;
use App\Domain\Models\Workspace\Workspace;
use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Infrastructure\Facades\TimeFacade;
use Illuminate\Support\Facades\DB;

class MetricsService
{
    public function workspaceDuration(int $year, int $month, ?Workspace $workspace): string {
        return TimeEntryRepository::getInstance()->monthHours($year, $month, $workspace);
    }
}
