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
            $table->string('dob', 50)->nullable();
            $table->string('any_allergies', 10)->nullable();
            $table->text('details_any_allergies_0_text')->nullable();
            $table->string('any_medication', 10)->nullable();
            $table->text('details_any_medication_1_text')->nullable();
            $table->text('asthma_inhaler_details')->nullable();
            $table->text('details_services_112_text')->nullable();
            $table->text('details_services_111_text')->nullable();
            $table->text('details_services_110_text')->nullable();
            $table->text('details_services_109_text')->nullable();
            $table->text('details_services_100_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'dob', 'any_allergies', 'details_any_allergies_0_text', 
                'any_medication', 'details_any_medication_1_text', 
                'asthma_inhaler_details', 'details_services_112_text', 
                'details_services_111_text', 'details_services_110_text', 
                'details_services_109_text', 'details_services_100_text'
            ]);
        });
    }
};
