<?php

namespace App\Interfaces\Http\Jobs\Import;

use App\Infrastructure\Enums\ImportTypeEnum;
use App\Interfaces\Http\Jobs\Import\Base\BaseImport;

class ImportTimeEntries extends BaseImport
{
    protected readonly ImportTypeEnum $importEnum;

    public function __construct() {
        $this->importEnum = ImportTypeEnum::TIME_ENTRIES;
    }

    protected function getImportMethod(): string {
        return 'importTimeEntries';
    }
}
