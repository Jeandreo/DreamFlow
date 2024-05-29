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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('wallet_id')->nullable();
            $table->integer('credit_card_id')->nullable();
            $table->integer('category_id');
            $table->string('name');
            $table->integer('hitching')->nullable();
            $table->boolean('recurrent')->default(false);
            $table->decimal('value', 10, 2)->default(0);
            $table->decimal('value_paid', 10, 2)->default(0);
            $table->date('date_venciment')->nullable();
            $table->date('date_payment')->nullable();
            $table->boolean('paid')->default(false);
            $table->decimal('fees', 10, 2)->default(0);
            $table->text('description')->nullable();
            $table->boolean('status')->default(false);
            $table->integer('created_by');
            $table->integer('filed_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
