<?php

namespace App\Interfaces\Http\Controllers\Tracker;

use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Base\ResourceController;
use App\Infrastructure\Interfaces\TrackerServiceInterface;
use Illuminate\Http\JsonResponse;

final class TrackerController extends ResourceController
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
            $users = $this->service->users();

            return $this->response($users);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }

    public function scrapeUsers(): JsonResponse {
        try {
            $users = $this->service->scrapeUsers();

            return $this->response($users);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }

    public function timeEntries(): JsonResponse {
        try {
            $timeEntries = $this->service->timeEntries();

            return $this->response($timeEntries);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }

    public function scrapeTimeEntries(): JsonResponse {
        try {
            $timeEntries = $this->service->scrapeTimeEntries();

            return $this->response($timeEntries);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), [], $exception->getCode());
        }
    }
}
