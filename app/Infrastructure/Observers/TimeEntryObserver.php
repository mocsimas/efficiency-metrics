<?php

namespace App\Infrastructure\Observers;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Infrastructure\Base\BaseModel;
use App\Infrastructure\Base\BaseObserver;

class TimeEntryObserver extends BaseObserver
{
    public function creating(BaseModel $model) {
        $model->duration = $this->calculateDuration($model);

        return $model;
    }

    public function updating(BaseModel $model) {
        $model->duration = $this->calculateDuration($model);

        return $model;
    }

    private function calculateDuration(TimeEntry $timeEntry): int {
        return $timeEntry->ended_at->diffInSeconds($timeEntry->started_at);
    }
}
