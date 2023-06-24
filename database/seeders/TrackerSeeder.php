<?php

namespace Database\Seeders;

use App\Domain\Models\Tracker\Tracker;
use App\Infrastructure\Enums\TrackerEnum;
use Illuminate\Database\Seeder;

class TrackerSeeder extends Seeder
{
    public function run(): void
    {
        foreach(TrackerEnum::cases() as $enum)
            Tracker::firstOrCreate([
                'type' => $enum->value,
                'key' => null,
            ]);
    }
}
