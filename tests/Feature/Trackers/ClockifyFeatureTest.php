<?php

namespace Tests\Feature\Trackers;

use App\Infrastructure\Base\BaseFeatureTest;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClockifyFeatureTest extends BaseFeatureTest
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
    }

    /** @test */
    public function can_get_all_clockify_api_users() {
        $response = $this->get("api/{$this->trackerEnum->value}/users");
        $response->assertStatus(200);
    }
}
