<?php

namespace App\Interfaces\Http\Controllers\Import;

use App\Domain\Services\ImportService;
use App\Infrastructure\Base\BaseController;
use App\Interfaces\Http\Jobs\Import\Import;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImportController extends BaseController
{
    public function __construct(
        protected readonly ImportService $service,
    ) {}

    public function import(): JsonResponse {
        try {
            Import::dispatch();

            return $this->response(true);
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }
}
