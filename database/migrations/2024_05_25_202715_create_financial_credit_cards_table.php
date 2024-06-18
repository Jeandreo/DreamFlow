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
        Schema::create('financial_credit_cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_numbers')->nullable();
            $table->decimal('limit', 10, 2);
            $table->integer('wallet_id');
            $table->integer('closing_day');
            $table->integer('due_day');
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('financial_credit_cards');
    }
};
