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
        Schema::table('financial_credit_cards', function (Blueprint $table) {
            $table->integer('institution_id')->nullable()->after('wallet_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_credit_cards', function (Blueprint $table) {
            $table->dropColumn('institution_id');
        });
    }
};
