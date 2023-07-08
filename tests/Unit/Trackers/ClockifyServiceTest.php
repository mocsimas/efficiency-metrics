<?php

namespace Tests\Unit\Trackers;

use App\Domain\Services\Tracker\ClockifyService;
use App\Infrastructure\Base\BaseUnitTest;
use Illuminate\Support\Collection;

final class ClockifyServiceTest extends BaseUnitTest
{
    private readonly ClockifyService $service;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->service = new ClockifyService();
    }

    /** @test */
    public function can_get_clockify_service_workspaces(): void
    {
        $collection = $this->service->workspaces();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }

    /** @test */
    public function can_get_clockify_service_users(): void
    {
        $collection = $this->service->users();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }

    /** @test */
    public function can_get_clockify_service_time_entries(): void
    {
        $collection = $this->service->timeEntries();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }

    /** @test */
    public function can_get_clockify_service_projects(): void
    {
        $collection = $this->service->projects();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }

    /** @test */
    public function can_get_clockify_service_tasks(): void
    {
        $collection = $this->service->tasks();

        $this->assertInstanceOf(Collection::class, $collection);

        $this->assertNotEmpty($collection);
    }
}
