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
            $table->date('started_at');
            $table->date('ended_at');
            $table->string('duration');
            $table->string('tracker');
            $table->uuid('workspace_uuid');
            $table->uuid('project_uuid');
            $table->uuid('task_uuid')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_entries');
    }
};
