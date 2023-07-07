<?php

namespace App\Interfaces\Http\Jobs\Import;

use App\Infrastructure\Enums\ImportTypeEnum;
use App\Interfaces\Http\Jobs\Import\Base\BaseImport;

class ImportUsers extends BaseImport
{
    protected readonly ImportTypeEnum $importEnum;

    public function __construct() {
        $this->importEnum = ImportTypeEnum::USERS;
    }

    protected function getImportMethod(): string {
        return 'importUsers';
    }
}
