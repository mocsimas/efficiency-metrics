<?php

namespace App\Interfaces\Http\Controllers\Metric;

use App\Domain\Models\Workspace\Workspace;
use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Domain\Services\MetricsService;
use App\Infrastructure\Base\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MetricController extends BaseController
{
    public function __construct(
        protected readonly MetricsService $service,
    ) {}

    public function validator(Request $request, string $type) {
        return match($type) {
            'hours' => $request->validate([
                'year' => 'required|date_format:Y',
                'month' => 'required|date_format:n',
            ]),
        };
    }

    public function duration(Workspace $workspace, Request $request): JsonResponse {
        $payload = $this->validator($request, 'hours');

        try {
            return $this->response($this->service->duration($payload['year'], $payload['month'], $workspace));
        } catch(\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }
}
