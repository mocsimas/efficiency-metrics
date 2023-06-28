<?php

namespace App\Domain\Models\Tracker;

use App\Infrastructure\Base\BaseRepository;

class TrackerRepository extends BaseRepository
{
    public function __construct(
        protected readonly Tracker $model,
    ) {}

    protected static function getArgs(): array {
        return [new Tracker()];
    }
}
