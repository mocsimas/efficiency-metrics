<?php

namespace Tests\Feature\Trackers;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Domain\Models\User\User;
use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Base\BaseFeatureTest;
use App\Infrastructure\Enums\TrackerEnum;

final class ClockifyFeatureTest extends BaseFeatureTest
{
    private readonly TrackerEnum $trackerEnum;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->trackerEnum = TrackerEnum::CLOCKIFY;
    }

    /** @test */
    public function can_get_all_clockify_api_workspaces() {
        $response = $this->get("api/{$this->trackerEnum->value}/workspaces");
        $response->assertStatus(200);

        $content = $response->json()['data'];

        if(!count($content)) {
            $this->markTestAsRisky('Clockify API returned empty workspaces. Therefore unable to test workspace content.');
            return;
        }

        $responseWorkspace = $content[0];

        $this->assertArrayHasKey($this->trackerEnum->getTrackerIdKey(Workspace::class), $responseWorkspace);
        $this->assertArrayHasKey('name', $responseWorkspace);
    }

    /** @test */
    public function can_get_all_clockify_api_users() {
        $response = $this->get("api/{$this->trackerEnum->value}/users");
        $response->assertStatus(200);

        $content = $response->json()['data'];

        if(!count($content)) {
            $this->markTestAsRisky('Clockify API returned empty users. Therefore unable to test user content.');
            return;
        }

        $responseUser = $content[0];

        $this->assertArrayHasKey($this->trackerEnum->getTrackerIdKey(User::class), $responseUser);
        $this->assertArrayHasKey('name', $responseUser);
    }

    /** @test */
    public function can_get_all_clockify_api_time_entries() {
        Workspace::factory()->create([
            'tracker' => $this->trackerEnum->value,
            'tracker_workspace_id' => config('tracker.clockify.test.workspace.id')
        ]);

        User::factory()->create([
            'tracker' => $this->trackerEnum->value,
            'tracker_user_id' => config('tracker.clockify.test.user.id')
        ]);

        $response = $this->get("api/{$this->trackerEnum->value}/time-entries");
        $response->assertStatus(200);

        $content = $response->json()['data'];

        if(!count($content)) {
            $this->markTestAsRisky('Clockify API returned empty time entries. Therefore unable to test time entries content.');
            return;
        }

        $responseTimeEntry = $content[0];

        $this->assertArrayHasKey($this->trackerEnum->getTrackerIdKey(TimeEntry::class), $responseTimeEntry);
        $this->assertArrayHasKey('description', $responseTimeEntry);
        $this->assertArrayHasKey('userId', $responseTimeEntry);
        $this->assertArrayHasKey('taskId', $responseTimeEntry);
        $this->assertArrayHasKey('projectId', $responseTimeEntry);
        $this->assertArrayHasKey('timeInterval', $responseTimeEntry);
        $this->assertArrayHasKey('start', $responseTimeEntry['timeInterval']);
        $this->assertIsDate($responseTimeEntry['timeInterval']['start']);
        $this->assertArrayHasKey('end', $responseTimeEntry['timeInterval']);
        $this->assertIsDate($responseTimeEntry['timeInterval']['end']);
        $this->assertArrayHasKey('workspaceId', $responseTimeEntry);
    }
}
