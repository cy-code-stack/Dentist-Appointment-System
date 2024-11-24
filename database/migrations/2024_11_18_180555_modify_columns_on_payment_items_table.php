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
            $table->dropColumn('date');
            $table->dropColumn('tooth');
            $table->dropColumn('surface');
            $table->date('payment_date')->nullable()->after('payment_appointment_id');
            $table->string('fee')->nullable();
            $table->string('paid')->nullable();
            $table->string('balance')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('ref_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_items', function (Blueprint $table) {
            $table->dropColumn('payment_date');
            $table->dropColumn('fee');
            $table->dropColumn('balance');
            $table->dropColumn('payment_method');
            $table->dropColumn('ref_number');
        });
    }
};
