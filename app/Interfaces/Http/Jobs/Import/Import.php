<?php

namespace App\Interfaces\Http\Jobs\Import;

use App\Infrastructure\Enums\ImportTypeEnum;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Traits\Job\Import\ImportJobTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Import implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ImportJobTrait;

    protected readonly ImportTypeEnum $importEnum;

    public function __construct()
    {
        $this->importEnum = ImportTypeEnum::ALL;
    }

    public function handle(): void
    {
        $this->beforeHandle(null);

        foreach(TrackerEnum::cases() as $enum) {
            $service = $enum->getService();

            foreach(['importWorkspaces', 'importUsers', 'importProjects', 'importTasks', 'importTimeEntries'] as $method)
                if(!$service->{$method}())
                    throw new \Exception('Failed to import');
        }

        $this->afterHandle();
    }
}
