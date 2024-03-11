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
        Schema::create('projects_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('status_id')->default(1);
            $table->integer('designated_id');
            $table->boolean('checked')->default(false);
            $table->integer('priority')->default(0);
            $table->dateTime('date')->nullable();
            $table->string('name');
            $table->string('phrase')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('filed_by')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tasks');
    }
};
