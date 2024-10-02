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
        Schema::table('teeth_diseases', function (Blueprint $table) {
            $table->renameColumn('disease_url', 'disease_img_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teeth_diseases', function (Blueprint $table) {
            $table->renameColumn('disease_img_url', 'disease_url');
        });
    }
};
