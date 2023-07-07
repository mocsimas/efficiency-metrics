<?php

namespace Tests\Feature;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Base\BaseFeatureTest;

class MetricsTest extends BaseFeatureTest
{
    /** @test */
    public function can_get_workspace_work_duration() {
        $workspaces = Workspace::factory(3)->create();
        $workspace = $workspaces->random();

        $date = new \DateTimeImmutable();

        TimeEntry::factory(3)->create([
            'workspace_uuid' => Workspace::factory()->create()->uuid,
        ]);

        TimeEntry::factory()->create([
            'started_at' => $date,
            'ended_at' => $date->modify('+1 hour +14 minutes +11 seconds'),
            'workspace_uuid' => $workspace->uuid,
        ]);

        TimeEntry::factory()->create([
            'started_at' => $date,
            'ended_at' => $date->modify('+34 minutes +11 seconds'),
            'workspace_uuid' => $workspace->uuid,
        ]);


        $response = $this->get("/api/metrics/workspaces/{$workspace->uuid}/duration?year={$date->format('Y')}&month={$date->format('n')}");
        $response->assertStatus(200);

        $duration = $response->json()['data'];

        $this->assertEquals($duration, '01:48:22');
    }
}
