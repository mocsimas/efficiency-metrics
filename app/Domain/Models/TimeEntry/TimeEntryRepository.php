<?php

namespace App\Domain\Models\TimeEntry;

use App\Infrastructure\Base\ResourceRepository;
use App\Infrastructure\Traits\Repository\HasTrackerTrait;
use Illuminate\Support\Facades\DB;
use Time;

class TimeEntryRepository extends ResourceRepository
{
    use HasTrackerTrait;

    protected const ORDER = 'started_at';

    public function __construct(TimeEntry $model) {
        $this->model = $model;
    }

    protected static function getArgs(): array {
        return [new TimeEntry()];
    }

    public function monthHours(int $year, int $month): string {
        $duration = $this->getModelQueryBuilder()
            ->whereYear('started_at', '=', $year)
            ->whereMonth('started_at', '=', $month)
            ->sum('duration');

        return Time::secondsToDuration($duration);
    }
}
