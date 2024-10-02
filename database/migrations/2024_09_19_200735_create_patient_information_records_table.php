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
        Schema::create('patient_information_records', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('place_of_birth')->nullable();
            $table->string('guardian')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('chief_complaint')->nullable();
            $table->string('previous_dentist')->nullable();
            $table->string('last_dental_visit')->nullable();
            $table->string('physician_name')->nullable();
            $table->string('specialty')->nullable();
            $table->string('office_address')->nullable();
            $table->string('office_number')->nullable();
            $table->string('good_health')->nullable();
            $table->string('medical_treatment')->nullable();
            $table->string('surgical_operation')->nullable();
            $table->string('hospitalized')->nullable();
            $table->string('prescribtion_non_rescribtion_medication')->nullable();
            $table->string('tabacco_products')->nullable();
            $table->string('dangerous_drugs')->nullable();
            $table->string('allergy')->nullable();
            $table->string('pregnant')->nullable();
            $table->string('nursing_mother')->nullable();
            $table->string('birth_control_pills')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('health_problem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_information_records');
    }
};
