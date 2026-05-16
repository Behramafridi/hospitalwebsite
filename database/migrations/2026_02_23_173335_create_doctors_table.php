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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('register_id')->nullable();
            $table->string('appointmentType')->nullable();
            $table->string('appointmentDate')->nullable();
            $table->string('timeSlot')->nullable();
            $table->string('registeremail')->nullable();
            $table->string('registerpassword')->nullable();
            $table->string('textarea')->nullable();
            $table->string('pdf')->nullable();
            $table->string('hasMedicalHistory')->nullable();
            $table->string('medicationDetails')->nullable();
            $table->string('hasAllergies')->nullable();
            $table->string('allergyDetails')->nullable();
            $table->string('medicalHistoryDetails')->nullable();
            $table->string('prescriptionDelivery')->nullable();
            $table->string('full_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('allergies')->nullable();
            $table->string('medication')->nullable();
            $table->string('gender')->nullable();
              $table->string('pharmacyCountry')->nullable();
            $table->string('pharmacyName')->nullable();
            $table->string('patient_first_name')->nullable();
             $table->string('patient_last_name')->nullable();
             $table->string('bod_of_birth')->nullable();
              $table->string('mobile')->nullable();
              $table->string('patient_foam_gender')->nullable();
               $table->string('media')->nullable();
               $table->string('foam_textarea')->nullable();
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
