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
            $table->foreignId('user_id')->after('appointment_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_appointments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
