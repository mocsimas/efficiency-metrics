<?php

namespace Tests\Feature;

use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Base\BaseFeatureTest;

final class WorkspaceFeatureTest extends BaseFeatureTest
{
    /** @test */
    public function can_get_all_workspaces() {
        Workspace::factory(4)->create();

        $response = $this->get('/api/workspaces');
        $response->assertStatus(200);

        $content = $response->json()['data'];

        $this->assertCount(4, $content);
    }
}
