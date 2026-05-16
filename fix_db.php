<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$columns = DB::select('DESCRIBE patient_registrations');
foreach ($columns as $column) {
    if (strpos($column->Type, 'varchar') !== false) {
        $field = $column->Field;
        echo "Converting $field to TEXT...\n";
        try {
            DB::statement("ALTER TABLE patient_registrations MODIFY COLUMN $field TEXT");
        } catch (\Exception $e) {
            echo "Failed $field: " . $e->getMessage() . "\n";
        }
    }
}

echo "Adding google_meet_link...\n";
try {
    DB::statement("ALTER TABLE patient_registrations ADD COLUMN google_meet_link TEXT NULL AFTER appointmentType");
    echo "Added to patient_registrations.\n";
} catch (\Exception $e) {
    echo "Failed adding google_meet_link to patient_registrations: " . $e->getMessage() . "\n";
}

try {
    DB::statement("ALTER TABLE doctors ADD COLUMN google_meet_link TEXT NULL AFTER appointmentType");
    echo "Added to doctors.\n";
} catch (\Exception $e) {
    echo "Failed adding google_meet_link to doctors: " . $e->getMessage() . "\n";
}
