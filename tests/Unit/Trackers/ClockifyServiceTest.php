<?php

namespace Tests\Unit\Trackers;

use App\Domain\Models\Project\Project;
use App\Domain\Models\User\User;
use App\Domain\Models\Workspace\Workspace;
use App\Domain\Services\Tracker\ClockifyService;
use App\Infrastructure\Base\BaseUnitTest;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Support\Collection;

final class ClockifyServiceTest extends BaseUnitTest
{
    private function getService(): ClockifyService {
        return new ClockifyService();
    }

    private function createClockifyWorkspace() {
        $trackerWorkspace = $this->getService()->workspaces()->first();

        return Workspace::factory()->create([
            'tracker' => TrackerEnum::CLOCKIFY,
            'tracker_id' => $trackerWorkspace[TrackerEnum::CLOCKIFY->getTrackerIdKey(Workspace::class)],
        ]);
    }

    private function createClockifyUser() {
        $tackerUser = $this->getService()->users()->first();

        return User::factory()->create([
            'tracker' => TrackerEnum::CLOCKIFY,
            'tracker_id' => $tackerUser[TrackerEnum::CLOCKIFY->getTrackerIdKey(User::class)],
        ]);
    }

    private function createClockifyProject() {
        $workspace = $this->createClockifyWorkspace();

        $trackerProject = $this->getService()->projects()->first();

        return Project::factory()->create([
            'tracker' => TrackerEnum::CLOCKIFY,
            'tracker_id' => $trackerProject[TrackerEnum::CLOCKIFY->getTrackerIdKey(Project::class)],
            'workspace_uuid' => $workspace,
        ]);
    }

    /** @test */
    public function can_get_clockify_service_workspaces(): void
    {
        $collection = $this->getService()->workspaces();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }

    /** @test */
    public function can_get_clockify_service_users(): void
    {
        $collection = $this->getService()->users();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }

    /** @test */
    public function can_get_clockify_service_time_entries(): void
    {
        $this->createClockifyWorkspace();

        $this->createClockifyUser();

        $collection = $this->getService()->timeEntries();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }

    /** @test */
    public function can_get_clockify_service_projects(): void
    {
        $this->createClockifyWorkspace();

        $collection = $this->getService()->projects();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }

    /** @test */
    public function can_get_clockify_service_tasks(): void
    {
        $this->createClockifyProject();

        $collection = $this->getService()->tasks();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }
}
