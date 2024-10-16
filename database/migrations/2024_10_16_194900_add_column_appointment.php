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
        Schema::table('appointment', function (Blueprint $table) {
            $table->string('payment')->nullable()->after('sched_time');
            $table->string('payment_method')->nullable()->after('payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointment', function (Blueprint $table) {
            $table->dropColumn('payment');
            $table->dropColumn('payment_method');
        });
    }
};
