<?php

namespace Database\Factories\Domain\Models\Workspace;

use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\Workspace\Workspace>
 */
class WorkspaceFactory extends Factory
{
    protected $model = Workspace::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'tracker' => TrackerEnum::CLOCKIFY->value,
            'tracker_workspace_id' => $this->faker->numberBetween(1000000, 99999999),
            'tracker_title' => $this->faker->name(),
            'scrape_date' => $this->faker->dateTime(),
        ];
    }
}
