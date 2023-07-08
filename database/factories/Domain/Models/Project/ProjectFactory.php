<?php

namespace Database\Factories\Domain\Models\Project;

use App\Domain\Models\Project\Project;
use App\Domain\Models\Workspace\Workspace;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Models\Project\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'tracker' => TrackerEnum::CLOCKIFY->value,
            'tracker_id' => $this->faker->numberBetween(1000000, 99999999),
            'tracker_title' => $this->faker->name(),
            'import_date' => $this->faker->dateTime(),
            'workspace_uuid' => Workspace::all()->first()?->uuid ?: Workspace::factory()->create()->uuid,
        ];
    }
}
