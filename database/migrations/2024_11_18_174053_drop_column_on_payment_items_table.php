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
        Schema::table('payment_items', function (Blueprint $table) {
            $table->dropColumn('fee');
            $table->dropColumn('paid');
            $table->dropColumn('balance');
            $table->dropColumn('ref_number');
            $table->dropColumn('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_items', function (Blueprint $table) {
            $table->string('fee')->nullable();
            $table->string('paid')->nullable();
            $table->string('balance')->nullable();
            $table->string('payment_method');
            $table->string('ref_number');
        });
    }
};
