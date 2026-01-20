<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        // Dokter
        User::create([
            'nama' => 'Dr. Budi Santoso',
            'alamat' => 'Jl. Sudirman No. 123',
            'no_ktp' => '1234567890123456',
            'no_hp' => '081234567890',
            'email' => 'dokter@gmail.com',
            'password' => Hash::make('dokter'),
            'role' => 'dokter',
        ]);

        // Pasien
        User::create([
            'nama' => 'Siti Aminah',
            'alamat' => 'Jl. Merdeka No. 45',
            'no_ktp' => '6543210987654321',
            'no_hp' => '089876543210',
            'no_rm' => 'RM-000001',
            'email' => 'pasien@gmail.com',
            'password' => Hash::make('pasien'),
            'role' => 'pasien',
        ]);
    }
}
