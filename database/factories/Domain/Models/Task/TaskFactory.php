<?php

namespace Database\Factories\Domain\Models\Task;

use App\Domain\Models\Project\Project;
use App\Domain\Models\Task\Task;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\Task\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'tracker' => TrackerEnum::CLOCKIFY,
            'tracker_id' => $this->faker->numberBetween(1000000, 99999999),
            'tracker_title' => $this->faker->words(3, true),
            'import_date' => $this->faker->dateTime(),
            'project_uuid' => Project::factory()->create()->uuid,
        ];
    }
}
