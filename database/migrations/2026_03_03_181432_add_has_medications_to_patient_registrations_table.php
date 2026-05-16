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
        // Disable strict mode to allow adding columns to large tables
        DB::statement('SET SESSION innodb_strict_mode=OFF');

        if (!Schema::hasColumn('patient_registrations', 'hasMedications')) {
            Schema::table('patient_registrations', function (Blueprint $table) {
                $table->string('hasMedications', 10)->nullable()->after('medicalHistoryDetails');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('patient_registrations', 'hasMedications')) {
            Schema::table('patient_registrations', function (Blueprint $table) {
                $table->dropColumn('hasMedications');
            });
        }
    }
};
