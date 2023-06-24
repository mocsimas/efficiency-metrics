<?php

namespace App\Domain\Models\TimeEntry;

use App\Infrastructure\Base\BaseRepository;

class TimeEntryRepository extends BaseRepository
{
    /**
     * BaseRepository constructor.
     *
     * @param TimeEntry $model
     */
    public function __construct(TimeEntry $model) {
        $this->model = $model;
    }
}
