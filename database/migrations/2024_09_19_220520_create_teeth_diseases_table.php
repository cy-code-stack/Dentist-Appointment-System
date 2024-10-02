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
        Schema::create('adult_teeth_diseases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teeth_number')->nullable()->constrained('adult_teeths');
            $table->string('disease_name')->nullable();
            $table->string('disease_img_url')->nullable();
            $table->text('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teeth_diseases');
    }
};
