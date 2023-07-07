<?php

namespace App\Domain\Services;

use App\Domain\Events\Import\ImportEnded;
use App\Domain\Events\Import\ImportFailed;
use App\Domain\Events\Import\ImportStarted;
use App\Domain\Models\Import\Import;
use App\Domain\Models\Import\ImportRepository;
use App\Infrastructure\Enums\ImportTypeEnum;
use App\Infrastructure\Enums\TrackerEnum;
use Carbon\Carbon;

class ImportService
{
    private readonly ImportRepository $repository;

    public function __construct() {
        $this->repository = ImportRepository::getInstance();
    }

    public function startedImport(?TrackerEnum $trackerEnum, ImportTypeEnum $importEnum): Import {
        if(!$trackerEnum && ImportTypeEnum::ALL !== $importEnum)
            throw new \Exception('');

        $import = $this->repository->create([
            'started_at' => new \DateTime(),
            'ended_at' => null,
            'tracker' => $trackerEnum,
            'type' => $importEnum,
        ]);

        ImportStarted::dispatch($import);

        return $import;
    }

    public function endedImport(Import $import): Import {
        $endedImport = $this->repository->update([
            'uuid' => $import->uuid,
            'ended_at' => new \DateTime(),
        ]);

        ImportEnded::dispatch($endedImport);

        return $endedImport;
    }

    public function failedImport(Import $import) {
        $failedImport = $this->repository->update([
            'uuid' => $import->uuid,
            'error_at' => new \DateTime(),
        ]);

        ImportFailed::dispatch($failedImport);

        return $failedImport;
    }
}
