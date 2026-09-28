<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default local administrator for demonstration / evaluation
        User::firstOrCreate(
            ['email' => 'admin@olympia.edu.my'],
            [
                'name' => 'HR Director (Demo)',
                'password' => Hash::make(env('ADMIN_DEFAULT_PASSWORD', 'OlympiaAdmin2026!')),
                'role' => 'hr_admin',
                'department' => 'Human Resources & Talent Management',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'recruiter@olympia.edu.my'],
            [
                'name' => 'Talent Acquisition Specialist',
                'password' => Hash::make('OlympiaRecruiter2026!'),
                'role' => 'hr_admin',
                'department' => 'Talent Acquisition',
                'email_verified_at' => now(),
            ]
        );
    }
}
