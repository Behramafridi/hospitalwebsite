<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use DYNAMIC row format to support large row sizes (many columns)
        DB::statement('SET SESSION innodb_strict_mode=OFF');

        Schema::create('patient_registrations', function (Blueprint $table) {
            $table->id();

            // Appointment Wizard Fields
            $table->string('appointmentType', 100)->nullable();
            $table->string('appointmentDate', 50)->nullable();
            $table->string('timeSlot', 50)->nullable();
            $table->string('registeremail', 150)->nullable();
            $table->string('registerpassword', 150)->nullable();
            $table->text('textarea')->nullable();
            $table->string('image', 200)->nullable();
            $table->string('hasMedicalHistory', 10)->nullable();
            $table->text('medicationDetails')->nullable();
            $table->string('hasAllergies', 10)->nullable();
            $table->text('allergyDetails')->nullable();
            $table->text('medicalHistoryDetails')->nullable();

            // Common Patient Fields
            $table->string('full_name', 150)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('height', 30)->nullable();
            $table->string('weight', 30)->nullable();
            $table->text('medical_conditions')->nullable();
            $table->text('allergies')->nullable();
            $table->text('medication')->nullable();
            $table->string('services_before', 50)->nullable();
            $table->string('services_yes', 10)->nullable();
            $table->string('services_no', 10)->nullable();

            // Prescription Delivery Fields
            $table->string('prescriptionDelivery', 50)->nullable();
            $table->string('devlivaryCountry', 50)->nullable();
            $table->string('devlivaryName', 100)->nullable();
            $table->string('pharmacyCountry', 50)->nullable();
            $table->string('pharmacyName', 100)->nullable();
            $table->string('pharmacyPhone', 30)->nullable();

            // Form 1: Asthma
            $table->string('diagnosed_asthma', 10)->nullable();
            $table->text('asthma_diag_details')->nullable();
            $table->string('current_inhales', 10)->nullable();
            $table->text('current_inhales_details')->nullable();
            $table->string('night_symptoms', 10)->nullable();
            $table->text('asthma_night_details')->nullable();
            $table->string('Hospital_admissions', 10)->nullable();
            $table->text('Hospital_admissions_details')->nullable();
            $table->string('symptoms_frequency', 50)->nullable();
            $table->string('triggers', 100)->nullable();

            // Form 2: Migraine / Hypothyroidism
            $table->string('both_sides', 50)->nullable();
            $table->string('aura_present', 10)->nullable();
            $table->string('Nausea_vomiting', 10)->nullable();
            $table->string('Current_medication', 100)->nullable();
            $table->string('by_doctor', 10)->nullable();
            $table->string('current_dose', 100)->nullable();
            $table->string('test_date', 50)->nullable();
            $table->string('symptoms_worsening', 10)->nullable();
            $table->string('planning_pregnancy', 10)->nullable();

            // Form 3: Hay Fever / Allergies
            $table->string('year_round', 50)->nullable();
            $table->string('main_symptoms', 100)->nullable();
            $table->string('asthma_history', 10)->nullable();
            $table->string('medications_tried', 100)->nullable();
            $table->string('eye_symptoms', 10)->nullable();

            // Form 5: Contraception
            $table->string('contraception', 100)->nullable();
            $table->string('contraception_before', 10)->nullable();
            $table->string('menstrual_period', 50)->nullable();
            $table->string('you_smoke', 10)->nullable();
            $table->string('had_blood', 10)->nullable();
            $table->string('with_aura', 10)->nullable();
            $table->string('blood_pressure', 10)->nullable();
            $table->string('breastfeeding', 10)->nullable();
            $table->string('effects_before', 10)->nullable();

            // Form 6: Period Delay
            $table->string('last_period', 50)->nullable();
            $table->string('your_period', 50)->nullable();
            $table->string('delaying', 50)->nullable();
            $table->string('medication_before', 10)->nullable();
            $table->string('blood_clots', 10)->nullable();
            $table->string('pregnant', 10)->nullable();
            $table->string('disorders', 100)->nullable();

            // Form 7: Genital Thrush
            $table->string('experiencing', 100)->nullable();
            $table->string('discharge', 100)->nullable();
            $table->string('been_present', 50)->nullable();
            $table->string('episode', 50)->nullable();
            $table->string('urination', 10)->nullable();
            $table->string('recently', 10)->nullable();

            // Form 8: Bacterial Vaginosis
            $table->string('vaginal_discharge', 10)->nullable();
            $table->string('color', 50)->nullable();
            $table->string('of_symptoms', 50)->nullable();
            $table->string('Previous_by', 10)->nullable();
            $table->string('pelvic_pain', 10)->nullable();
            $table->string('you_pregnant', 10)->nullable();
            $table->string('IUD', 10)->nullable();

            // Form 9: Erectile Dysfunction
            $table->string('issue_existed', 50)->nullable();
            $table->string('any_erection', 10)->nullable();
            $table->string('gradual_onset', 10)->nullable();
            $table->string('heart_disease', 10)->nullable();
            $table->string('Diabetes', 10)->nullable();
            $table->string('alcohol_intake', 10)->nullable();
            $table->string('ED_medication', 10)->nullable();

            // Form 10: Premature Ejaculation
            $table->string('ejaculation', 10)->nullable();
            $table->string('Lifelong', 10)->nullable();
            $table->string('anxiety', 10)->nullable();
            $table->string('Any_erectile', 10)->nullable();
            $table->string('treatment_before', 100)->nullable();

            // Form 11 & 12: Acne Skin Condition
            $table->string('loss_started', 50)->nullable();
            $table->string('Family_history', 10)->nullable();
            $table->string('hair_loss', 50)->nullable();
            $table->string('loss_products', 10)->nullable();
            $table->string('scalp_disease', 10)->nullable();
            $table->string('whiteheads', 10)->nullable();
            $table->string('Areas_affected', 100)->nullable();
            $table->string('Duration', 50)->nullable();
            $table->string('Severity', 50)->nullable();
            $table->string('any_treatments', 50)->nullable();
            $table->string('Hormonal_issues', 10)->nullable();

            // Form 13: Rosacea Skin Condition
            $table->string('Facial_redness', 10)->nullable();
            $table->string('skin_triggers', 100)->nullable();
            $table->string('Pimples_present', 10)->nullable();
            $table->string('steroid_creams', 10)->nullable();

            // Form 14: Eczema Skin Condition
            $table->string('Itching_severity', 50)->nullable();
            $table->string('Childhood_eczema', 10)->nullable();
            $table->string('infections_present', 10)->nullable();

            // Form 15: Psoriasis Skin Condition
            $table->string('Location_of', 100)->nullable();
            $table->string('Nail_nvolvement', 10)->nullable();
            $table->string('Joint_pain', 10)->nullable();
            $table->string('Family', 10)->nullable();
            $table->string('Previous_treatments', 100)->nullable();

            // Additional Patient Info
            $table->string('patient_first_name', 100)->nullable();
            $table->string('patient_last_name', 100)->nullable();
            $table->string('bod_of_birth', 50)->nullable();
            $table->string('mobile', 30)->nullable();
            $table->string('patient_foam_gender', 20)->nullable();
            $table->string('media', 200)->nullable();
            $table->text('foam_textarea')->nullable();
            $table->string('doctor_id', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_registrations');
    }
};
