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
        if (\Illuminate\Support\Facades\DB::connection()->getConfig('driver') === 'mysql') {
            \Illuminate\Support\Facades\DB::statement('SET SESSION innodb_strict_mode=OFF');
        }

        Schema::table('patient_registrations', function (Blueprint $table) {
            $table->text('by_doctor')->nullable()->change();
            $table->text('symptoms_worsening')->nullable()->change();
            $table->text('planning_pregnancy')->nullable()->change();
            $table->text('diagnosed_asthma')->nullable()->change();
            $table->text('current_inhales')->nullable()->change();
            $table->text('night_symptoms')->nullable()->change();
            $table->text('Hospital_admissions')->nullable()->change();
            $table->text('both_sides')->nullable()->change();
            $table->text('aura_present')->nullable()->change();
            $table->text('Nausea_vomiting')->nullable()->change();
            $table->text('asthma_history')->nullable()->change();
            $table->text('eye_symptoms')->nullable()->change();
            $table->text('any_allergies')->nullable()->change();
            $table->text('any_medication')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_registrations', function (Blueprint $table) {
            $table->string('by_doctor', 10)->nullable()->change();
            $table->string('symptoms_worsening', 10)->nullable()->change();
            $table->string('planning_pregnancy', 10)->nullable()->change();
            $table->string('diagnosed_asthma', 10)->nullable()->change();
            $table->string('current_inhales', 10)->nullable()->change();
            $table->string('night_symptoms', 10)->nullable()->change();
            $table->string('Hospital_admissions', 10)->nullable()->change();
            $table->string('both_sides', 50)->nullable()->change();
            $table->string('aura_present', 10)->nullable()->change();
            $table->string('Nausea_vomiting', 10)->nullable()->change();
            $table->string('asthma_history', 10)->nullable()->change();
            $table->string('eye_symptoms', 10)->nullable()->change();
            $table->string('any_allergies', 10)->nullable()->change();
            $table->string('any_medication', 10)->nullable()->change();
        });
    }
};
