<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Create Admin User
            User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Admin User',
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'email_verified_at' => now(),
                ]
            );

            // Create Doctor User
            User::firstOrCreate(
                ['email' => 'doctor@example.com'],
                [
                    'name' => 'Dr. John Doe',
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                    'email_verified_at' => now(),
                ]
            );

            // Create Patient User
            User::firstOrCreate(
                ['email' => 'patient@example.com'],
                [
                    'name' => 'Patient One',
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'email_verified_at' => now(),
                ]
            );

            // Create additional test users (only if they don't exist)
            $patientCount = User::where('role', 'patient')->count();
            if ($patientCount < 5) {
                User::factory(5 - $patientCount)->create([
                    'role' => 'patient',
                ]);
            }

            $doctorCount = User::where('role', 'doctor')->count();
            if ($doctorCount < 2) {
                User::factory(2 - $doctorCount)->create([
                    'role' => 'doctor',
                ]);
            }
        });

        $this->command->info('Database seeded successfully!');
    }
}
