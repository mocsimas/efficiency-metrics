<?php

namespace Database\Factories\Domain\Models\User;

use App\Domain\Models\User\User;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\User\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'tracker' => TrackerEnum::CLOCKIFY->value,
            'tracker_user_id' => $this->faker->numberBetween(100000, 99999999),
            'tracker_name' => $this->faker->name(),
        ];
    }
}
