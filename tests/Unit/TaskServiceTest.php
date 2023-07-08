<?php

namespace Tests\Unit;

use App\Domain\Models\Project\Project;
use App\Domain\Models\Task\Task;
use App\Domain\Models\Workspace\Workspace;
use App\Domain\Services\Model\ProjectService;
use App\Domain\Services\Model\TaskService;
use App\Infrastructure\Base\BaseUnitTest;
use App\Infrastructure\Enums\TrackerEnum;

final class TaskServiceTest extends BaseUnitTest
{
    private readonly TaskService $service;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->service = new TaskService();
    }

    /** @test */
    public function can_create_clockify_tasks(): void
    {
        $trackerEnum = TrackerEnum::CLOCKIFY;

        $this->assertCount(0, Task::all());

        $apiTasks = collect([
            [
                'id' => rand(100000, 99999999),
                'name' => 'Test task',
                'projectId' => Project::factory()->create()->tracker_id,
            ],
            [
                'id' => rand(100000, 99999999),
                'name' => 'Test task 2',
                'projectId' => Project::factory()->create()->tracker_id,
            ],
        ]);

        $this->service->create($trackerEnum, $apiTasks, new \DateTime());

        $this->assertCount(2, Task::all());
    }
}
