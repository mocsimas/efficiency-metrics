<?php

namespace App\Interfaces\Http\Controllers\Tracker;

use App\Infrastructure\Base\BaseController;
use App\Infrastructure\Contracts\TrackerServiceContract;
use Illuminate\Http\JsonResponse;

final class TrackerController extends BaseController
{
    public function __construct(
        protected readonly TrackerServiceContract $service,
    ) {}

    public function workspaces(): JsonResponse {
        try {
            $workspaces = $this->service->workspaces();

            return $this->response($workspaces);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }

    public function importWorkspaces(): JsonResponse {
        try {
            $workspaces = $this->service->importWorkspaces();

            return $this->response($workspaces);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }

    public function users(): JsonResponse {
        try {
            $users = $this->service->users();

            return $this->response($users);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }

    public function importUsers(): JsonResponse {
        try {
            $users = $this->service->importUsers();

            return $this->response($users);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }

    public function timeEntries(): JsonResponse {
        try {
            $timeEntries = $this->service->timeEntries();

            return $this->response($timeEntries);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }

    public function importTimeEntries(): JsonResponse {
        try {
            $timeEntries = $this->service->importTimeEntries();

            return $this->response($timeEntries);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), $exception?->errors() ?: [], $exception->getCode(), $exception);
        }
    }
}
