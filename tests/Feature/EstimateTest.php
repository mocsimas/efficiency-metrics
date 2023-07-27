<?php

namespace Tests\Feature;

use App\Domain\Models\Estimate\Estimate;
use App\Domain\Models\Task\Task;
use App\Infrastructure\Base\BaseFeatureTest;

class EstimateTest extends BaseFeatureTest
{
    /** @test */
    public function can_get_estimates() {
        Estimate::factory(4)->create();

        $response = $this->get('/api/estimates');
        $response->assertStatus(200);

        $data = $response->json()['data'];

        $this->assertCount(4, $data);
    }

    /** @test */
    public function can_create_estimate() {
        $payload = [
            'task_uuid' => Task::factory()->create()->uuid,
            'from' => 6000,
            'to' => 6000,
        ];

        $response = $this->post('/api/estimates/create', $payload);
        $response->assertStatus(200);

        $data = $response->json()['data'];

        $this->assertEquals($payload['task_uuid'], $data['task_uuid']);
        $this->assertEquals($payload['from'], $data['from']);
        $this->assertEquals($payload['to'], $data['to']);
    }

    /** @test */
    public function can_edit_estimate() {
        $estimate = Estimate::factory()->create();

        $payload = [
            'uuid' => $estimate->uuid,
            'task_uuid' => $estimate->task->uuid,
            'from' => 6000,
            'to' => 6000,
        ];

        $response = $this->post('/api/estimates/update', $payload);
        $response->assertStatus(200);

        $data = $response->json()['data'];

        $this->assertEquals($payload['uuid'], $data['uuid']);
        $this->assertEquals($payload['task_uuid'], $data['task_uuid']);
        $this->assertEquals($payload['from'], $data['from']);
        $this->assertEquals($payload['to'], $data['to']);
    }
}
