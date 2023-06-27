<?php

namespace App\Domain\Services;

use App\Domain\Models\User\User;
use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\TrackerServiceInterface;
use App\Interfaces\Http\Jobs\ScrapeUsers;
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
            'tracker_workspace_id' => $workspace[$this->getTrackerEnum()->getTrackerIdKey(Workspace::class)],
            'tracker_title' => $workspace['name'],
        ];
    }

    public function mapUser(array $user): array {
        return [
            'name' => $user['name'],
            'tracker' => $this->getTrackerEnum()->value,
            'tracker_user_id' => $user[$this->getTrackerEnum()->getTrackerIdKey(User::class)],
            'tracker_name' => $user['name'],
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

    public function users(): Collection {
        $response = $this->http->get('/v1/user');

        if(!$response->successful()) {
            if($response->status() === 401)
                throw new UnauthorizedException('Unauthorized.');

            throw new \Exception('Failed to fetch users.');
        }

        return collect([$response->json()]);
    }

    public function scrapeUsers(): bool {
        $users = $this->users();

        ScrapeUsers::dispatch($this->getTrackerEnum(), $users);

        return true;
    }
}
