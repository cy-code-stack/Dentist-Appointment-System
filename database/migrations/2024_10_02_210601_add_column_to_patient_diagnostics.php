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
        Schema::table('patient_diagnostics', function (Blueprint $table) {
            $table->foreignId('disease_id')->nullable()->after('teeth_id')->constrained('adult_teeth_diseases');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_diagnostics', function (Blueprint $table) {
            //
        });
    }
};
