<?php

namespace Tests\Unit;

use App\Domain\Models\Project\Project;
use App\Domain\Models\Workspace\Workspace;
use App\Domain\Services\Model\ProjectService;
use App\Infrastructure\Base\BaseUnitTest;
use App\Infrastructure\Enums\TrackerEnum;

final class ProjectServiceTest extends BaseUnitTest
{
    private readonly ProjectService $service;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->service = new ProjectService();
    }

    /** @test */
    public function can_create_clockify_projects(): void
    {
        $trackerEnum = TrackerEnum::CLOCKIFY;

        $this->assertCount(0, Project::all());

        $apiProjects = collect([
            [
                'id' => rand(100000, 99999999),
                'name' => 'Test project',
                'workspaceId' => Workspace::factory()->create()->tracker_id,
            ],
            [
                'id' => rand(100000, 99999999),
                'name' => 'Test project 2',
                'workspaceId' => Workspace::factory()->create()->tracker_id,
            ],
        ]);

        $this->service->create($trackerEnum, $apiProjects, new \DateTime());

        $this->assertCount(2, Project::all());
    }
}
