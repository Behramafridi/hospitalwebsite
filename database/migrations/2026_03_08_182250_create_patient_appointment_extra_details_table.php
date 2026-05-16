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
        Schema::create('patient_appointment_extra_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_registration_id');
            
            // Counseling Fields
            $table->text('counseling_reason')->nullable();
            $table->text('previous_therapy')->nullable();
            $table->text('emergency_contact')->nullable();
            
            // Other extra fields that might overflow the main table
            $table->text('extra_area')->nullable();
            $table->text('extra_type')->nullable();
            $table->text('extra_symptoms')->nullable();
            $table->text('extra_severity')->nullable();
            
            $table->timestamps();

            // Foreign key
            $table->foreign('patient_registration_id', 'fk_patient_reg_extra')
                  ->references('id')->on('patient_registrations')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_appointment_extra_details');
    }
};
