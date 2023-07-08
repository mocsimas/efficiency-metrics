<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid()->unique();
            $table->string('title');
            $table->string('tracker');
            $table->string('tracker_id');
            $table->string('tracker_title');
            $table->datetime('import_date');
            $table->uuid('workspace_uuid');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
