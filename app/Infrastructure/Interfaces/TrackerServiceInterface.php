<?php

namespace App\Infrastructure\Interfaces;

use Illuminate\Support\Collection;

interface TrackerServiceInterface
{
    public function getWorkspaces(): Collection;

//    public function timeEntries(): Collection;
}
