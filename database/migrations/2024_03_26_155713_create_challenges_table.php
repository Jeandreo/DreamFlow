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
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['mensal', 'semanal']);
            $table->string('url');
            $table->string('date')->nullable();
            $table->date('custom_start')->nullable();
            $table->date('custom_end')->nullable();
            $table->text('description')->nullable();
            $table->integer('position')->default(0);
            $table->integer('status')->default(true);
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
        Schema::dropIfExists('challenges');
    }
};
