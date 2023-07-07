<?php

namespace App\Interfaces\Http\Jobs\Import;

use App\Infrastructure\Enums\ImportTypeEnum;
use App\Infrastructure\Enums\TrackerEnum;
use App\Interfaces\Http\Jobs\Import\Base\BaseImport;

class Import extends BaseImport
{
    protected readonly ImportTypeEnum $importEnum;

    public function __construct()
    {
        $this->importEnum = ImportTypeEnum::ALL;
    }

    public function handle(): void
    {
        $this->beforeHandle();

        foreach(TrackerEnum::cases() as $trackerEnum) {
            $service = $trackerEnum->getService();

            foreach(['importWorkspaces', 'importUsers', 'importTimeEntries'] as $method) {
                $isSuccessful = $service->{$method}();

                if(!$isSuccessful)
                    return;
            }
        }

        $this->afterHandle();
    }
}
