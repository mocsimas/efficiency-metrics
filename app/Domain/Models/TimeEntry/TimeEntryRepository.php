<?php

namespace App\Domain\Models\TimeEntry;

use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Base\ResourceRepository;
use App\Infrastructure\Traits\Repository\HasScrapeDateTrait;
use App\Infrastructure\Traits\Repository\HasTrackerTrait;
use Illuminate\Support\Facades\DB;
use Time;

class TimeEntryRepository extends ResourceRepository
{
    use HasTrackerTrait, HasScrapeDateTrait;

    protected const ORDER = 'started_at';

    public function __construct(TimeEntry $model) {
        $this->model = $model;
    }

    protected static function getArgs(): array {
        return [new TimeEntry()];
    }

    public function monthHours(int $year, int $month, ?Workspace $workspace): string {
        $query = $this->getModelQueryBuilder();

        if($workspace)
            $query = $query->whereRelation('workspace', 'uuid', '=', $workspace->uuid);

        $query = $query
            ->whereYear('started_at', '=', $year)
            ->whereMonth('started_at', '=', $month);

        return Time::secondsToDuration($query->sum('duration'));
    }
}
