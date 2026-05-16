<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change some columns to text to avoid "Row size too large"
        Schema::table('patient_registrations', function (Blueprint $table) {
            $table->text('textarea')->nullable()->change();
            $table->text('medicationDetails')->nullable()->change();
            $table->text('allergyDetails')->nullable()->change();
            $table->text('medicalHistoryDetails')->nullable()->change();
            $table->text('foam_textarea')->nullable()->change();
        });

        Schema::table('patient_registrations', function (Blueprint $table) {
            $table->string('google_meet_link')->nullable()->after('appointmentType');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->string('google_meet_link', 500)->nullable()->after('appointmentType');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_registrations', function (Blueprint $table) {
            $table->dropColumn('google_meet_link');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('google_meet_link');
        });
    }
};
