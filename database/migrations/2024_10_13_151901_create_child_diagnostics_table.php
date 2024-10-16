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
        Schema::create('child_diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('information_id')->nullable()->constrained('patient_information_records');
            $table->foreignId('teeth_id')->nullable()->constrained('child_teeths');
            $table->foreignId('disease_id')->nullable()->constrained('child_diseases');
            $table->string('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_diagnostics');
    }
};
