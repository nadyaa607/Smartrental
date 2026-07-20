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
    $this->call([
        AdminSeeder::class,
    ]);
        
        $userPelanggan = User::create([
            'name' => 'Pelanggan',
            'email' => 'pelanggan@smartrental.test',
            'no_hp' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'pelanggan',
        ]);

        Pelanggan::create([
            'user_id' => $userPelanggan->id,
            'kode_pelanggan' => 'PLG-000001',
            'nama' => 'Pelanggan',
            'email' => 'pelanggan@smartrental.test',
            'no_identitas' => '1301234567890001',
            'telepon' => '081234567890',
            'alamat' => 'Batusangkar, Sumatera Barat',
        ]);
    }
}