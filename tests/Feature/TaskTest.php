<?php

namespace Tests\Feature;

use App\Domain\Models\Task\Task;
use App\Infrastructure\Base\BaseFeatureTest;

final class TaskTest extends BaseFeatureTest
{
    /** @test */
    public function can_get_all_time_entries() {
        Task::factory(4)->create();

        $response = $this->get('/api/tasks');
        $response->assertStatus(200);

        $content = $response->json()['data'];

        $this->assertCount(4, $content);
    }
}
