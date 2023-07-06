<?php

namespace App\Infrastructure\Interfaces;

use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

interface TrackerServiceInterface
{
    public function getTrackerEnum(): TrackerEnum;

    public function mapWorkspace(array $workspace, \DateTime $scrapeDate): array;

    public function mapUser(array $user, \DateTime $scrapeDate): array;

    public function mapTimeEntry(array $timeEntry, \DateTime $scrapeDate): array;

    public function workspaces(): Collection;

    public function scrapeWorkspaces(): bool;

    public function users(): Collection;

    public function scrapeUsers(): bool;

    public function timeEntries(): Collection;

    public function scrapeTimeEntries(): bool;
}
