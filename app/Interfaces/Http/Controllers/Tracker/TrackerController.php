<?php

namespace App\Interfaces\Http\Controllers\Tracker;

use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\TrackerServiceInterface;
use Illuminate\Http\JsonResponse;

final class TrackerController extends BaseController
{
    public function __construct(
        protected readonly TrackerServiceInterface $service,
    ) {}

    public function index(): JsonResponse {
        try {
            $workspaces = $this->service->getWorkspaces();

            return $this->response($workspaces);
        } catch (\Exception $exception) {
            $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }
}
