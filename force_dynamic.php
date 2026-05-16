<?php

use Illuminate\Support\Facades\DB;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    DB::statement('ALTER TABLE patient_registrations ROW_FORMAT=DYNAMIC');
    echo "Converted to DYNAMIC.\n";
} catch (\Exception $e) {
    echo "Failed to convert to DYNAMIC: " . $e->getMessage() . "\n";
}

try {
    DB::statement("ALTER TABLE patient_registrations ADD COLUMN google_meet_link TEXT NULL AFTER appointmentType");
    echo "Added google_meet_link.\n";
} catch (\Exception $e) {
    echo "Failed to add column: " . $e->getMessage() . "\n";
}
