<?php

namespace App\Domain\Services\Tracker;

use App\Domain\Models\Project\Project;
use App\Domain\Models\Project\ProjectRepository;
use App\Domain\Models\Task\Task;
use App\Domain\Models\Task\TaskRepository;
use App\Domain\Models\TimeEntry\TimeEntry;
use App\Domain\Models\User\User;
use App\Domain\Models\User\UserRepository;
use App\Domain\Models\Workspace\Workspace;
use App\Domain\Models\Workspace\WorkspaceRepository;
use App\Domain\Services\Model\ProjectService;
use App\Domain\Services\Model\TaskService;
use App\Domain\Services\Model\TimeEntryService;
use App\Domain\Services\Model\UserService;
use App\Domain\Services\Model\WorkspaceService;
use App\Domain\Services\TrackerService;
use App\Infrastructure\Enums\TrackerEnum;
use App\Infrastructure\Interfaces\TrackerServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use function collect;

class ClockifyService extends TrackerService implements TrackerServiceInterface
{
    private $http;

    private readonly WorkspaceRepository $workspaceRepository;

    private readonly UserRepository $userRepository;

    private readonly ProjectRepository $projectRepository;

    private readonly TaskRepository $taskRepository;

    public function __construct() {
        $this->http = Http::{$this->getTrackerEnum()->getHttpMacroName()}();

        $this->workspaceRepository = WorkspaceRepository::getInstance();

        $this->userRepository = UserRepository::getInstance();

        $this->projectRepository = ProjectRepository::getInstance();

        $this->taskRepository = TaskRepository::getInstance();
    }

    public function getTrackerEnum(): TrackerEnum {
        return TrackerEnum::CLOCKIFY;
    }

    public function mapWorkspace(array $workspace, \DateTime $importDate): array {
        return [
            'title' => $workspace['name'],
            'tracker' => $this->getTrackerEnum()->value,
            'tracker_id' => $workspace[$this->getTrackerEnum()->getTrackerIdKey(Workspace::class)],
            'tracker_title' => $workspace['name'],
            'import_date' => $importDate,
        ];
    }

    public function mapUser(array $user, \DateTime $importDate): array {
        return [
            'name' => $user['name'],
            'tracker' => $this->getTrackerEnum()->value,
            'tracker_id' => $user[$this->getTrackerEnum()->getTrackerIdKey(User::class)],
            'tracker_name' => $user['name'],
            'import_date' => $importDate,
        ];
    }

    public function mapTimeEntry(array $timeEntry, \DateTime $importDate): array {
        $userId = $timeEntry['userId'] ?? null;
        $user = $userId ? $this->userRepository->find('tracker_id', $userId) : null;

        $workspaceId = $timeEntry['workspaceId'] ?? null;
        $workspace = $workspaceId ? $this->workspaceRepository->find('tracker_id', $workspaceId) : null;

        $projectId = $timeEntry['projectId'] ?? null;
        $project = $projectId ? $this->projectRepository->find('tracker_id', $projectId) : null;

        $taskId = $timeEntry['taskId'] ?? null;
        $task = $taskId ? $this->taskRepository->find('tracker_id', $taskId) : null;

        return [
            'title' => $timeEntry['description'],
            'started_at' => Carbon::parse($timeEntry['timeInterval']['start']),
            'ended_at' => Carbon::parse($timeEntry['timeInterval']['end']),
            'tracker' => $this->getTrackerEnum()->value,
            'tracker_id' => $timeEntry[$this->getTrackerEnum()->getTrackerIdKey(TimeEntry::class)],
            'tracker_title' => $timeEntry['description'],
            'user_uuid' => $user->uuid,
            'workspace_uuid' => $workspace->uuid,
            'project_uuid' => $project?->uuid,
            'task_uuid' => $task?->uuid,
            'import_date' => $importDate,
        ];
    }

    public function mapProject(array $project, \DateTime $importDate): array {
        return [
            'title' => $project['name'],
            'tracker' => $this->getTrackerEnum()->value,
            'tracker_id' => $project[$this->getTrackerEnum()->getTrackerIdKey(Project::class)],
            'tracker_title' => $project['name'],
            'import_date' => $importDate,
            'workspace_uuid' => $this->workspaceRepository->find('tracker_id', $project['workspaceId'])->uuid,
        ];
    }

    public function mapTask(array $task, \DateTime $importDate): array {
        return [
            'title' => $task['name'],
            'tracker' => $this->getTrackerEnum()->value,
            'tracker_id' => $task[$this->getTrackerEnum()->getTrackerIdKey(Task::class)],
            'tracker_title' => $task['name'],
            'import_date' => $importDate,
            'project_uuid' => $this->projectRepository->find('tracker_id', $task['projectId'])->uuid,
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

    public function importWorkspaces(): bool {
        $workspaces = $this->workspaces();

        try {
            (new WorkspaceService())->create($this->getTrackerEnum(), $workspaces, new \DateTime());
        } catch(\Exception $exception) {
            return false;
        }

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

    public function importUsers(): bool {
        $users = $this->users();

        try {
            (new UserService())->create($this->getTrackerEnum(), $users, new \DateTime());
        } catch(\Exception $exception) {
            return false;
        }

        return true;
    }

    public function timeEntries(int $page = 1, int $pageSize = 50): Collection {
        $workspaces = WorkspaceRepository::getInstance()->findByTracker($this->getTrackerEnum());

        $users = UserRepository::getInstance()->findByTracker($this->getTrackerEnum());

        $timeEntries = collect([]);

        foreach($users as $user) {
            foreach($workspaces as $workspace) {
                $response = $this->http->get("/v1/workspaces/{$workspace->tracker_id}/user/{$user->tracker_id}/time-entries?page=$page&page-size=$pageSize");

                if($response->successful()) {
                    $timeEntries = $timeEntries->merge(collect($response->json()));
                    continue;
                }

                Log::error("Failed to fetch Clockify time entries");
            }
        }

        return $timeEntries;
    }

    public function importTimeEntries(): bool {
        $timeEntries = $this->timeEntries(1, 1000);

        try {
            (new TimeEntryService())->create($this->getTrackerEnum(), $timeEntries, new \DateTime());
        } catch(\Exception $exception) {
            return false;
        }

        return true;
    }

    public function projects(): Collection {
        $workspaces = WorkspaceRepository::getInstance()->findByTracker($this->getTrackerEnum());

        $projects = collect([]);

        foreach($workspaces as $workspace) {
            $response = $this->http->get("/v1/workspaces/{$workspace->tracker_id}/projects");

            if($response->successful()) {
                $projects = $projects->merge(collect($response->json()));
                continue;
            }

            Log::error("Failed to fetch Clockify projects");
        }

        return $projects;
    }

    public function importProjects(): bool {
        $projects = $this->projects();

        try {
            (new ProjectService())->create($this->getTrackerEnum(), $projects, new \DateTime());
        } catch(\Exception $exception) {
            return false;
        }

        return true;
    }

    public function tasks(): Collection {
        $projects = ProjectRepository::getInstance()->findByTracker($this->getTrackerEnum());

        $tasks = collect([]);

        foreach($projects as $project) {
            $workspace = $project->workspace;

            $response = $this->http->get("/v1/workspaces/{$workspace->tracker_id}/projects/{$project->tracker_id}/tasks");

            if($response->successful()) {
                $tasks = $tasks->merge(collect($response->json()));
                continue;
            }

            Log::error("Failed to fetch Clockify tasks");
        }

        return $tasks;
    }

    public function importTasks(): bool {
        $tasks = $this->tasks();

        try {
            (new TaskService())->create($this->getTrackerEnum(), $tasks, new \DateTime());
        } catch(\Exception $exception) {
            return false;
        }

        return true;
    }
}
