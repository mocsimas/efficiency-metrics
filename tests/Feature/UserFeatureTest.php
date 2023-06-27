<?php

namespace Tests\Feature;

use App\Domain\Models\User\User;
use App\Infrastructure\Base\BaseFeatureTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserFeatureTest extends BaseFeatureTest
{
    /** @test */
    public function can_get_all_users() {
        User::factory(4)->create();

        $response = $this->get('/api/users');
        $response->assertStatus(200);

        $content = $response->json()['data'];

        $this->assertCount(4, $content);
    }
}
