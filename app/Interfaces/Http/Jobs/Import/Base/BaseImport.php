<?php

namespace App\Interfaces\Http\Jobs\Import\Base;

use App\Domain\Models\Import\Import;
use App\Domain\Services\ImportService;
use App\Infrastructure\Enums\ImportTypeEnum;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class BaseImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected readonly Import $import;

    protected readonly ImportTypeEnum $importEnum;

    abstract protected function getImportMethod(): string;

    final protected function getImportService(): ImportService {
        return new ImportService();
    }

    final protected function beforeHandle(TrackerEnum $trackerEnum): void {
        $this->import = $this->getImportService()->startedImport(
            $this->importEnum === ImportTypeEnum::ALL ? null : $trackerEnum,
            $this->importEnum
        );
    }

    final protected function afterHandle(): void {
        $this->getImportService()->endedImport($this->import);
    }

    final public function handle(): void
    {
        foreach(TrackerEnum::cases() as $enum) {
            $this->beforeHandle($enum);

            $enum->getService()->{$this->getImportMethod()}();

            $this->afterHandle();
        }
    }

    final public function failed(\Throwable $exception): void {
        $this->getImportService()->failedImport($this->import);
    }
}
