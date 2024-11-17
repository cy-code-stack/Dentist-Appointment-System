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
        Schema::table('payment_appointments', function (Blueprint $table) {
            $table->dropColumn('tooth');
            $table->dropColumn('surface');
            $table->dropColumn('date');
            $table->dropColumn('treatment_rendered');
            $table->dropColumn('paid');
            $table->dropColumn('balance');
            $table->dropColumn('fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_appointments', function (Blueprint $table) {
            //
        });
    }
};
