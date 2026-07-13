<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@eballot.com'],
            [
                'full_names' => 'System Admin',
                'is_admin' => true,
                'document_type' => 'NIN',
                'document' => '1234567890',
                'phone_number' => '08000000000',
                'gender' => 'Male',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );
    }
}
