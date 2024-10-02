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
        Schema::rename('patient_diagnostics', 'teeths');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('teeths', 'patient_diagnostics');
    }
};
