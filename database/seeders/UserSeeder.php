<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@unida.gontor.ac.id',
            'nim' => '202400001',
            'password' => Hash::make('password'),
            'points' => 0,
        ]);

        echo "✓ User Admin berhasil dibuat!\n";
    }
}