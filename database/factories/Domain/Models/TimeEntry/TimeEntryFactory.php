<?php

namespace Database\Factories\Domain\Models\TimeEntry;

use App\Domain\Models\TimeEntry\TimeEntry;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\TimeEntry\TimeEntry>
 */
class TimeEntryFactory extends Factory
{
    protected $model = TimeEntry::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'started_at' => $this->faker->dateTime(),
            'ended_at' => $this->faker->dateTime(),
            'duration' => $this->faker->numberBetween(10000, 99999),
            'tracker' => TrackerEnum::CLOCKIFY->value,
            'tracker_time_entry_id' => $this->faker->numberBetween(1000000, 99999999),
            'tracker_title' => $this->faker->name(),
            'tracker_user_id' => $this->faker->numberBetween(100000, 9999999),
//            'workspace_uuid' => $this->faker->numberBetween(100000, 9999999),
//            'project_uuid' => $this->faker->numberBetween(100000, 9999999),
//            'task_uuid' => $this->faker->numberBetween(100000, 9999999),
        ];
    }
}
