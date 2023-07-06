<?php

namespace App\Interfaces\Http\Jobs;

use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Domain\Services\WorkspaceService;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ScrapeWorkspaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly TrackerEnum $trackerEnum,
        private readonly Collection $workspaces,
    ) {}

    public function handle(WorkspaceService $service): void
    {
        $service->createWorkspaces($this->trackerEnum, $this->workspaces, new \DateTime());
    }
}
