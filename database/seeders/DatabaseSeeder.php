<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * Registrasi publik hanya untuk pelanggan, jadi akun admin
     * disiapkan lewat seeder ini.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@smartrental.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $userPelanggan = User::create([
            'name' => 'Budi Santoso',
            'email' => 'pelanggan@smartrental.test',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
        ]);

        Pelanggan::create([
            'user_id' => $userPelanggan->id,
            'nama' => 'Budi Santoso',
            'no_identitas' => '1301234567890001',
            'telepon' => '081234567890',
            'alamat' => 'Batusangkar, Sumatera Barat',
        ]);
    }
}