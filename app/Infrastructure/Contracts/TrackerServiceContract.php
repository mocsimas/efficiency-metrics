<?php

namespace App\Infrastructure\Contracts;

use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

interface TrackerServiceContract
{
    public function getTrackerEnum(): TrackerEnum;

    public function mapWorkspace(array $workspace, \DateTime $importDate): array;

    public function mapUser(array $user, \DateTime $importDate): array;

    public function mapTimeEntry(array $timeEntry, \DateTime $importDate): array;

    public function mapProject(array $project, \DateTime $importDate): array;

    public function mapTask(array $task, \DateTime $importDate): array;

    public function workspaces(): Collection;

    public function importWorkspaces(): bool;

    public function users(): Collection;

    public function importUsers(): bool;

    public function timeEntries(): Collection;

    public function importTimeEntries(): bool;

    public function projects(): Collection;

    public function importProjects(): bool;

    public function tasks(): Collection;

    public function importTasks(): bool;
}
