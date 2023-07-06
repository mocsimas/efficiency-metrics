<?php

namespace Tests\Unit;

use App\Domain\Models\User\User;
use App\Domain\Services\UserService;
use App\Infrastructure\Base\BaseUnitTest;
use App\Infrastructure\Enums\TrackerEnum;

final class UserServiceTest extends BaseUnitTest
{
    private readonly UserService $service;

    public function __construct(string $name)
    {
        parent::__construct($name);

        $this->service = new UserService();
    }

    /** @test */
    public function can_create_tracker_users(): void
    {
        $trackerEnum = TrackerEnum::CLOCKIFY;

        $this->assertCount(0, User::all());

        $apiUsers = collect([
            [
                'id' => rand(100000, 99999999),
                'name' => 'test 1',
            ],
            [
                'id' => rand(100000, 99999999),
                'name' => 'test 2',
            ],
        ]);

        $this->service->createUsers($trackerEnum, $apiUsers, new \DateTime());

        $this->assertCount(2, User::all());
    }
}
