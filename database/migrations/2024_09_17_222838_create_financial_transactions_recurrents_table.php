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
        Schema::table('financial_transactions', function (Blueprint $table) {
            $table->dropColumn(['recurrent', 'recurrent_begin']);
        });

        Schema::table('financial_transactions', function (Blueprint $table) {
            $table->integer('recurrent_id')->after('category_id')->nullable();
        });
        
        Schema::create('financial_transactions_recurrents', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id');
            $table->date('start');
            $table->date('end')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions_recurrents');
    }
};
