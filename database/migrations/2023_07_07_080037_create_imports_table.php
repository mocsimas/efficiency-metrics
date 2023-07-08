<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Infrastructure\Enums\ImportTypeEnum;
use App\Infrastructure\Enums\TrackerEnum;

return new class extends Migration
{
    private const TRACKERS = [
        TrackerEnum::CLOCKIFY,
    ];

    private const TYPES = [
        ImportTypeEnum::ALL,
        ImportTypeEnum::USERS,
        ImportTypeEnum::WORKSPACES,
        ImportTypeEnum::TIME_ENTRIES,
        ImportTypeEnum::PROJECTS,
        ImportTypeEnum::TASKS,
    ];

    public function up(): void
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->uuid()->unique();
            $table->datetime('started_at');
            $table->datetime('ended_at')->nullable();
            $table->enum('tracker', array_map(fn(TrackerEnum $enum) => $enum->value, static::TRACKERS))->nullable();
            $table->enum('type', array_map(fn(ImportTypeEnum $enum) => $enum->value, static::TYPES));
            $table->datetime('error_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
};
