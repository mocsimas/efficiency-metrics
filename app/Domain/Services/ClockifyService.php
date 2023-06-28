<?php

namespace App\Domain\Services;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Domain\Models\User\User;
use App\Domain\Models\User\UserRepository;
use App\Domain\Models\Workspace\Workspace;
use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\TrackerServiceInterface;
use App\Interfaces\Http\Jobs\ScrapeTimeEntries;
use App\Interfaces\Http\Jobs\ScrapeUsers;
use App\Interfaces\Http\Jobs\ScrapeWorkspaces;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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

    public function mapTimeEntry(array $timeEntry): array {
        return [
            'title' => $timeEntry['description'],
            'started_at' => Carbon::parse($timeEntry['timeInterval']['start']),
            'ended_at' => Carbon::parse($timeEntry['timeInterval']['end']),
            'tracker' => $this->getTrackerEnum()->value,
            'tracker_time_entry_id' => $timeEntry[$this->getTrackerEnum()->getTrackerIdKey(TimeEntry::class)],
            'tracker_title' => $timeEntry['description'],
            'tracker_user_id' => $timeEntry['userId'],
//            'workspace_uuid' => null,
//            'project_uuid' => null,
//            'task_uuid' => null,
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

    public function timeEntries(int $page = 1, int $pageSize = 50): Collection {
        $workspaces = WorkspaceRepository::getInstance()->findByTracker($this->getTrackerEnum());

        $users = UserRepository::getInstance()->findByTracker($this->getTrackerEnum());

        $timeEntries = collect([]);

        foreach($users as $user) {
            foreach($workspaces as $workspace) {
                $response = $this->http->get("/v1/workspaces/{$workspace->tracker_workspace_id}/user/{$user->tracker_user_id}/time-entries?page=$page&page-size=$pageSize");

                if($response->successful()) {
                    $timeEntries = $timeEntries->merge(collect($response->json()));
                    continue;
                }

                Log::error("Failed to fetch Clockify time entries");
            }
        }

        return $timeEntries;
    }

    public function scrapeTimeEntries(): bool {
        $timeEntries = $this->timeEntries(1, 1000);

        ScrapeTimeEntries::dispatch($this->getTrackerEnum(), $timeEntries);

        return true;
    }
}
