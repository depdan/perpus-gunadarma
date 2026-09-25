<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gunadarma.ac.id'],
            [
                'name' => 'Administrator Perpustakaan',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'budi@gunadarma.ac.id'],
            [
                'name' => 'Budi Sudarsono',
                'password' => Hash::make('password'),
                'role' => 'peminjam',
                'email_verified_at' => now(),
            ]
        );
    }
}
