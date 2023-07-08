<?php

namespace Tests\Unit;

use App\Domain\Models\Workspace\Workspace;
use App\Domain\Services\Model\WorkspaceService;
use App\Infrastructure\Base\BaseUnitTest;
use App\Infrastructure\Enums\TrackerEnum;

final class WorkspaceServiceTest extends BaseUnitTest
{
    private readonly WorkspaceService $service;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->service = new WorkspaceService();
    }

    /** @test */
    public function can_create_clockify_workspaces(): void
    {
        $trackerEnum = TrackerEnum::CLOCKIFY;

        $this->assertCount(0, Workspace::all());

        $apiWorkspaces = collect([
            [
                'id' => rand(100000, 99999999),
                'name' => 'test 1',
            ],
            [
                'id' => rand(100000, 99999999),
                'name' => 'test 2',
            ],
        ]);

        $this->service->create($trackerEnum, $apiWorkspaces, new \DateTime());

        $this->assertCount(2, Workspace::all());
    }
}
