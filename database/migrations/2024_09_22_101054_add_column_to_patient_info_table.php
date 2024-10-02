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
        Schema::table('patient_information_records', function (Blueprint $table) {
            $table->string('birthdate')->nullable()->after('user_id');
            $table->string('religion')->nullable()->after('birthdate');
            $table->string('nationality')->nullable()->after('place_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_information_records', function (Blueprint $table) {
            $table->dropColumn('birthdate');
            $table->dropColumn('religion');
            $table->dropColumn('nationality');
        });
    }
};
