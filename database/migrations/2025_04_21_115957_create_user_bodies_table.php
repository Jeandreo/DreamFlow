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
        Schema::create('users_bodies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->float('weight');
            $table->float('height');
            $table->integer('age');
            $table->enum('gender', ['male', 'female']);
            $table->float('body_fat')->nullable();
            $table->enum('activity_level', ['sedentary', 'light', 'moderate', 'intense', 'extreme'])->default('sedentary');
            $table->float('bmr')->nullable();
            $table->float('total_calories')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_bodies');
    }
};
