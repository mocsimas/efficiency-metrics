<?php

namespace Tests\Feature;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Infrastructure\Base\BaseFeatureTest;

final class TimeEntryTest extends BaseFeatureTest
{
    /** @test */
    public function can_get_all_time_entries() {
        TimeEntry::factory(4)->create();

        $response = $this->get('/api/time-entries');
        $response->assertStatus(200);

        $content = $response->json()['data'];

        $this->assertCount(4, $content);
    }
}
