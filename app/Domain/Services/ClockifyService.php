<?php

namespace App\Domain\Services;

use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\TrackerServiceInterface;
use App\Interfaces\Http\Jobs\ScrapeWorkspaces;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\UnauthorizedException;

class ClockifyService extends TrackerService implements TrackerServiceInterface
{
    private $http;

    public function __construct() {
        $this->http = Http::{$this->getTrackerEnum()->getHttpMacroName()}();
    }

    public function getTrackerEnum(): TrackerEnum {
        return TrackerEnum::CLOCKIFY;
    }

    public function mapWorkspace(array $workspace): array {
        return [
            'title' => $workspace['name'],
            'tracker' => $this->getTrackerEnum()->value,
            'tracker_workspace_id' => $workspace[$this->getTrackerEnum()->getTrackerIdKey()],
            'tracker_title' => $workspace['name'],
        ];
    }

    public function workspaces(): Collection {
        $response = $this->http->get('/v1/workspaces');

        if(!$response->successful()) {
            if($response->status() === 401)
                throw new UnauthorizedException('Unauthorized.');

            throw new \Exception('Failed to fetch workspaces.');
        }

        return collect($response->json());
    }

    public function scrapeWorkspaces(): bool {
        $workspaces = $this->workspaces();

        ScrapeWorkspaces::dispatch($this->getTrackerEnum(), $workspaces);

        return true;
    }
}
