<?php

namespace App\Interfaces\Http\Jobs\Import\Base;

use App\Domain\Models\Import\Import;
use App\Domain\Services\ImportService;
use App\Infrastructure\Enums\ImportTypeEnum;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Traits\Job\Import\ImportJobTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class BaseImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ImportJobTrait;

    protected readonly Import $import;

    protected readonly ImportTypeEnum $importEnum;

    abstract protected function getImportMethod(): string;

    final public function handle(): void
    {
        foreach(TrackerEnum::cases() as $enum) {
            $this->beforeHandle($enum);

            $enum->getService()->{$this->getImportMethod()}();

            $this->afterHandle();
        }
    }
}
