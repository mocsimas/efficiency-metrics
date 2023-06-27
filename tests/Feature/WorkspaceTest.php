<?php

namespace Tests\Feature;

use App\Infrastructure\Base\BaseTest;

class WorkspaceTest extends BaseTest
{
    public function can_scrape_workspaces() {
        $this->get('/api/');
    }
}
