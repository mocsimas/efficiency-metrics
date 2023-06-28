<?php

namespace App\Domain\Models\TimeEntry;

use App\Infrastructure\Base\ResourceRepository;
use App\Infrastructure\Traits\Repository\HasTrackerTrait;

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
}
