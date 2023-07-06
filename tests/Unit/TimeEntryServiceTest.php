<?php

namespace Tests\Unit;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Domain\Models\User\User;
use App\Domain\Models\Workspace\Workspace;
use App\Domain\Services\TimeEntryService;
use App\Domain\Services\UserService;
use App\Infrastructure\Base\BaseUnitTest;
use App\Infrastructure\Enums\TrackerEnum;

final class TimeEntryServiceTest extends BaseUnitTest
{
    private readonly TimeEntryService $service;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->service = new TimeEntryService();
    }

    /** @test */
    public function can_create_time_entries(): void
    {
        $trackerEnum = TrackerEnum::CLOCKIFY;

        $this->assertCount(0, TimeEntry::all());

        $user = User::factory()->create();

        $workspace = Workspace::factory()->create();

        $apiUsers = collect([
            [
                'id' => rand(100000, 99999999),
                'description' => 'Test task',
                'timeInterval' => [
                    'start' => new \DateTime(),
                    'end' => new \DateTime(),
                ],
                'userId' => $user->tracker_user_id,
                'workspaceId' => $workspace->tracker_workspace_id,
            ],
            [
                'id' => rand(100000, 99999999),
                'description' => 'Test task 2',
                'timeInterval' => [
                    'start' => new \DateTime(),
                    'end' => new \DateTime(),
                ],
                'userId' => $user->tracker_user_id,
                'workspaceId' => $workspace->tracker_workspace_id,
            ],
        ]);

        $this->service->createTimeEntries($trackerEnum, $apiUsers, new \DateTime());

        $this->assertCount(2, TimeEntry::all());
    }
}
