<?php

namespace App\Domain\Services\Abstract;

use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

abstract class ModelService
{
    protected function generator(Collection $collection): \Generator {
        foreach($collection as $model)
            yield (array) $model;
    }

    abstract function create(TrackerEnum $trackerEnum, Collection $collection, \DateTime $importDate): void;
}
