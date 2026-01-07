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
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@rhemadelmission.org'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'), // Change this password after first login
                'role' => 'admin',
            ]
        );

        // You can add more admin users here
        // User::updateOrCreate(
        //     ['email' => 'another@admin.com'],
        //     [
        //         'name' => 'Another Admin',
        //         'password' => Hash::make('password'),
        //         'role' => 'admin',
        //     ]
        // );
    }
}
