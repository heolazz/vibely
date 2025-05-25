<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',  // Ganti dengan email yang kamu inginkan
            'password' => Hash::make('12345678'),  // Ganti dengan password yang kamu inginkan
            'role' => 'admin',  // Pastikan role admin sudah ada di tabel user
        ]);
    }
}
