<?php

namespace App\Infrastructure\Interfaces;

use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

interface TrackerServiceInterface
{
    public function getTrackerEnum(): TrackerEnum;

    public function mapWorkspace(array $workspace, \DateTime $importDate): array;

    public function mapUser(array $user, \DateTime $importDate): array;

    public function mapTimeEntry(array $timeEntry, \DateTime $importDate): array;

    public function mapProject(array $project, \DateTime $importDate): array;

    public function workspaces(): Collection;

    public function importWorkspaces(): bool;

    public function users(): Collection;

    public function importUsers(): bool;

    public function timeEntries(): Collection;

    public function importTimeEntries(): bool;

    public function projects(): Collection;

    public function importProjects(): bool;
}
