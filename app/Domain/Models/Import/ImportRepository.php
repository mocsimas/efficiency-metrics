<?php

namespace App\Domain\Models\Import;

use App\Infrastructure\Base\ResourceRepository;

class ImportRepository extends ResourceRepository
{
    public function __construct(
        protected readonly Import $model,
    ) {}

    protected static function getArgs(): array {
        return [new Import()];
    }
}
