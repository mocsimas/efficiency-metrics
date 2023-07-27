<?php

namespace App\Domain\Models\Estimate;

use App\Infrastructure\Base\ResourceRepository;

class EstimateRepository extends ResourceRepository
{
    public function __construct(
        protected readonly Estimate $model,
    ) {}

    protected static function getArgs(): array {
        return [new Estimate()];
    }
}
