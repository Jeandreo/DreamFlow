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
            $table->string('category');
            $table->string('base_quantity');
            $table->decimal('calories')->default(0);
            $table->decimal('proteins')->default(0);
            $table->decimal('carbohydrates')->default(0);
            $table->decimal('sodium')->default(0);
            $table->decimal('fats')->default(0);
            $table->decimal('fibers')->default(0);
            $table->text('notes')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('food');
    }
};
