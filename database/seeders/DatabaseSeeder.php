<?php

namespace Database\Seeders;

use App\Models\KategoriKendaraan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'phone_number' => '081234567890',
            'address' => 'Jl. Contoh No. 1',
            'role' => 'admin',
            'status' => 'active',
            'profile_picture' => null,
            'password' => bcrypt('password'), // Change to a secure password
        ]);
        User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'username' => 'user',
            'phone_number' => '089876543210',
            'address' => 'Jl. Contoh No. 2',
            'role' => 'user',
            'status' => 'active',
            'profile_picture' => null,
            'password' => bcrypt('password'), // Change to a secure password
        ]);

        // You can add more seeders here for other models if needed
        $this->call([
           KategoriKendaraanSeeder::class,
        ]);
    }
}
