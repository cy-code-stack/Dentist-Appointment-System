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
            $table->bigInteger('tooth')->unsigned()->nullable()->after('appointment_id');
            $table->string('surface')->nullable()->after('tooth');
            $table->bigInteger('paid')->nullable()->after('treatment_rendered');
            $table->bigInteger('balance')->nullable()->after('paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_appointments', function (Blueprint $table) {
            $table->dropColumn('tooth');
            $table->dropColumn('surface');
            $table->dropColumn('paid');
            $table->dropColumn('balance');
        });
    }
};
