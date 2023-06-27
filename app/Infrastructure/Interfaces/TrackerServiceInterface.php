<?php

namespace App\Infrastructure\Interfaces;

use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

interface TrackerServiceInterface
{
    public function getTrackerEnum(): TrackerEnum;

    public function mapWorkspace(array $workspace): array;

    public function workspaces(): Collection;

    public function scrapeWorkspaces(): bool;

//    public function timeEntries(): Collection;
}
