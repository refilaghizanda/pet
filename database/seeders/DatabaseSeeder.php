<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Admin No.1',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);
        $user1 = \App\Models\User::create([
            'name' => 'Pelanggan Satu',
            'username' => 'pelanggan1',
            'no_telepon' => '081111111111',
            'alamat' => 'Jl. Pelanggan No.1',
            'role' => 'pelanggan',
            'password' => bcrypt('pelanggan123'),
        ]);
        $user2 = \App\Models\User::create([
            'name' => 'Pelanggan Dua',
            'username' => 'pelanggan2',
            'no_telepon' => '082222222222',
            'alamat' => 'Jl. Pelanggan No.2',
            'role' => 'pelanggan',
            'password' => bcrypt('pelanggan123'),
        ]);

        // Seeder Layanan
        $layanan1 = \App\Models\Layanan::create([
            'nama' => 'Grooming',
            'deskripsi' => 'Perawatan dan pembersihan hewan',
            'harga' => 75000,
        ]);
        $layanan2 = \App\Models\Layanan::create([
            'nama' => 'Penitipan',
            'deskripsi' => 'Penitipan hewan harian',
            'harga' => 50000,
        ]);

        // Seeder Hewan

    }
}
