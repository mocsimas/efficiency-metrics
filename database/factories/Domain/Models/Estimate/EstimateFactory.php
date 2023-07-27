<?php

namespace Database\Factories\Domain\Models\Estimate;

use App\Domain\Models\Estimate\Estimate;
use App\Domain\Models\Task\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\Estimate\Estimate>
 */
class EstimateFactory extends Factory
{
    protected $model = Estimate::class;

    public function definition(): array
    {
        return [
            'task_uuid' => Task::factory()->create()->uuid,
            'from' => $this->faker->numberBetween(4000, 9000),
            'to' => $this->faker->numberBetween(9000, 15000),
        ];
    }
}
