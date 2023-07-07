<?php

namespace App\Infrastructure\Traits\Job\Import;

use App\Domain\Services\ImportService;
use App\Infrastructure\Enums\ImportTypeEnum;
use App\Infrastructure\Enums\TrackerEnum;

trait ImportJobTrait
{
    final protected function getImportService(): ImportService {
        return new ImportService();
    }

    final protected function beforeHandle(?TrackerEnum $trackerEnum): void {
        $this->import = $this->getImportService()->startedImport(
            $this->importEnum === ImportTypeEnum::ALL ? null : $trackerEnum,
            $this->importEnum
        );
    }

    final protected function afterHandle(): void {
        $this->getImportService()->endedImport($this->import);
    }

    final public function failed(\Throwable $exception): void {
        $this->getImportService()->failedImport($this->import);
    }
}
