<?php

namespace App\Interfaces\Http\Controllers\Metric;

use App\Domain\Models\Workspace\Workspace;
use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Domain\Services\MetricsService;
use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Requests\Metric\MetricWorkspaceDurationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MetricController extends BaseController
{
    public function __construct(
        protected readonly MetricsService $service,
    ) {}

    public function workspaceDuration(Workspace $workspace, MetricWorkspaceDurationRequest $request): JsonResponse {
        try {
            $year = $request->validated('year');
            $month = $request->validated('month');

            return $this->response($this->service->workspaceDuration($year, $month, $workspace));
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }
}
