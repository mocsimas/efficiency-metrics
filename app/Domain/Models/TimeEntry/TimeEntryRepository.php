<?php

namespace App\Domain\Models\TimeEntry;

use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Base\ResourceRepository;
use App\Infrastructure\Facades\TimeFacade;
use App\Infrastructure\Traits\Repository\HasImportDateTrait;
use App\Infrastructure\Traits\Repository\HasTrackerTrait;

class TimeEntryRepository extends ResourceRepository
{
    use HasTrackerTrait, HasImportDateTrait;

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

        return TimeFacade::secondsToDuration($query->sum('duration'));
    }
}
