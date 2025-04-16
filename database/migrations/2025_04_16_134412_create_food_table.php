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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // protein, carb, fat, fruit, etc.
            $table->string('base_quantity'); // e.g. "100g", "1 unit"
            $table->float('calories');
            $table->float('proteins');
            $table->float('carbohydrates');
            $table->float('fats');
            $table->float('fiber')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
