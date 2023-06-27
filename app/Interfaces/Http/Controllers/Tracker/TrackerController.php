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

    public function workspaces(): JsonResponse {
        try {
            $workspaces = $this->service->workspaces();

            return $this->response($workspaces);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }

    public function scrapeWorkspaces(): JsonResponse {
        try {
            $workspaces = $this->service->scrapeWorkspaces();

            return $this->response($workspaces);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }

    public function users(): JsonResponse {
        try {
            return $this->service->users();
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }

    public function scrapeUsers(): JsonResponse {
        try {
            return $this->service->scrapeUsers();
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }
}
