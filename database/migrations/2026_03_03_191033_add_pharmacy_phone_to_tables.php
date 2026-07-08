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
        if (\Illuminate\Support\Facades\DB::connection()->getConfig('driver') === 'mysql') {
            \Illuminate\Support\Facades\DB::statement('SET SESSION innodb_strict_mode=OFF');
        }

        if (!Schema::hasColumn('patient_registrations', 'pharmacyPhone')) {
            Schema::table('patient_registrations', function (Blueprint $table) {
                $table->string('pharmacyPhone', 30)->nullable()->after('pharmacyName');
            });
        }

        if (!Schema::hasColumn('doctors', 'pharmacyPhone')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->string('pharmacyPhone', 30)->nullable()->after('pharmacyName');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('patient_registrations', 'pharmacyPhone')) {
            Schema::table('patient_registrations', function (Blueprint $table) {
                $table->dropColumn('pharmacyPhone');
            });
        }

        if (Schema::hasColumn('doctors', 'pharmacyPhone')) {
            Schema::table('doctors', function (Blueprint $table) {
                $table->dropColumn('pharmacyPhone');
            });
        }
    }
};
