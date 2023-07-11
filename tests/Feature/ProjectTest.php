<?php

namespace Tests\Feature;

use App\Domain\Models\Project\Project;
use App\Domain\Models\Task\Task;
use App\Infrastructure\Base\BaseFeatureTest;

final class ProjectTest extends BaseFeatureTest
{
    /** @test */
    public function can_get_projects() {
        Project::factory(4)->create();

        $response = $this->get('/api/projects/');
        $response->assertStatus(200);

        $data = $response->json()['data'];

        $this->assertCount(4, $data);
    }

    /** @test */
    public function can_get_project_tasks() {
        Task::factory(2)->create();

        $project = Project::factory()->create();

        Task::factory(3)->create([
            'project_uuid' => $project->uuid,
        ]);

        $response = $this->get("/api/projects/{$project->uuid}/tasks");
        $response->assertStatus(200);

        $data = $response->json()['data'];

        $this->assertCount(3, $data);
        $this->assertEquals($project->uuid, $data[0]['project_uuid']);
        $this->assertEquals($project->uuid, $data[1]['project_uuid']);
        $this->assertEquals($project->uuid, $data[2]['project_uuid']);
    }
}
