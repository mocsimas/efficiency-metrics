<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_entries', function (Blueprint $table) {
            $table->uuid()->unique();
            $table->string('title');
            $table->datetime('started_at');
            $table->datetime('ended_at')->nullable();
            $table->unsignedMediumInteger('duration');
            $table->string('tracker');
            $table->string('tracker_time_entry_id');
            $table->string('tracker_title');
            $table->uuid('user_uuid');
            $table->uuid('workspace_uuid');
//            $table->uuid('workspace_uuid');
//            $table->uuid('project_uuid');
//            $table->uuid('task_uuid')->nullable();
            $table->datetime('import_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_entries');
    }
};
