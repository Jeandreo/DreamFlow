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

        Schema::dropIfExists('challenges_monthly');

        Schema::create('challenges_completed', function (Blueprint $table) {
            $table->id();
            $table->integer('challenge_id');
            $table->date('date');
            $table->boolean('completed')->default(false);
            $table->enum('type', ['mensal', 'semanal']);
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenges_completed');
    }
};
