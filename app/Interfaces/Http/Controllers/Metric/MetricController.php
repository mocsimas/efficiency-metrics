<?php

namespace App\Interfaces\Http\Controllers\Metric;

use App\Domain\Services\MetricsService;
use App\Infrastructure\Base\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MetricController extends BaseController
{
    public function __construct(
        protected readonly MetricsService $service,
    ) {}

    public function monthHours(): JsonResponse {
        try {
            return $this->response($this->service->monthHours(2023, 6));
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }
}
