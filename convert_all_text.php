<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$columns = DB::select('DESCRIBE patient_registrations');
foreach ($columns as $column) {
    if (strpos($column->Type, 'varchar') !== false) {
        $field = $column->Field;
        echo "Updating $field to TEXT...\n";
        try {
            DB::statement("ALTER TABLE patient_registrations MODIFY COLUMN $field TEXT");
        } catch (\Exception $e) {
            echo "Failed $field: " . $e->getMessage() . "\n";
        }
    }
}
