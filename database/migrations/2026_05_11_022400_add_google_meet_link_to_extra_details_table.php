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
        Schema::table('patient_appointment_extra_details', function (Blueprint $table) {
            $table->string('google_meet_link', 1000)->nullable()->after('extra_severity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_appointment_extra_details', function (Blueprint $table) {
            $table->dropColumn('google_meet_link');
        });
    }
};
