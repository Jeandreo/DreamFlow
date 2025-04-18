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
        Schema::create('meals_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_time_id')->onDelete('cascade');
            $table->foreignId('food_id')->nullable()->onDelete('cascade');
            $table->foreignId('dish_id')->nullable()->onDelete('cascade');
            $table->float('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals_items');
    }
};
