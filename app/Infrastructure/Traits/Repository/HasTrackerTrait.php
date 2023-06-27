<?php

namespace App\Infrastructure\Traits\Repository;

use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Collection;

trait HasTrackerTrait
{
    public function findByTracker(TrackerEnum $trackerEnum): Collection {
        return $this->getModelQueryBuilder()->where([
            ['tracker', '=', $trackerEnum->value]
        ])->get();
    }
}
