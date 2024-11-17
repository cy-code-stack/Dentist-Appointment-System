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
        Schema::create('payment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_appointment_id')->constrained('payment_appointments')->onDelete('cascade'); // Reference to payment_appointments
            $table->date('date');
            $table->string('tooth')->nullable();
            $table->string('surface')->nullable();
            $table->string('treatment_rendered');
            $table->decimal('fee', 10, 2); 
            $table->decimal('paid', 10, 2)->default(0); 
            $table->decimal('balance', 10, 2)->default(0)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_items');
    }
};
