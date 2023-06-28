<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_entries', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->string('title');
            $table->datetime('started_at');
            $table->datetime('ended_at');
            $table->unsignedMediumInteger('duration');
            $table->string('tracker');
            $table->string('tracker_time_entry_id');
            $table->string('tracker_title');
            $table->string('tracker_user_id');
//            $table->uuid('workspace_uuid');
//            $table->uuid('project_uuid');
//            $table->uuid('task_uuid')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_entries');
    }
};
