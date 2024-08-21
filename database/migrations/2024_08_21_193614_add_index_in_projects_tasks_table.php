<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects_tasks', function (Blueprint $table) {
            $table->index('task_id');
            $table->index('designated_id');
            $table->index('status_id');
            $table->index('project_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects_tasks', function (Blueprint $table) {
            $table->dropIndex(['task_id']);
            $table->dropIndex(['designated_id']);
            $table->dropIndex(['status_id']);
            $table->dropIndex(['project_id']);
            $table->dropIndex(['date']);
        });
    }
};
