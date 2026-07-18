<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan form registrasi.
     * Registrasi publik selalu membuat akun dengan role "pelanggan".
     * Akun admin dibuat lewat seeder / oleh admin lain, bukan lewat form ini.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Memproses registrasi pelanggan baru.
     * Membuat 1 baris di tabel users (akun login) dan 1 baris di tabel
     * pelanggans (profil) sekaligus dalam satu transaksi database.
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'pelanggan',
            ]);

            Pelanggan::create([
                'user_id' => $user->id,
                'nama' => $validated['name'],
                'no_identitas' => $validated['no_identitas'],
                'telepon' => $validated['telepon'],
                'alamat' => $validated['alamat'],
            ]);

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false))
            ->with('success', 'Registrasi berhasil! Selamat datang, '.$user->name.'.');
    }
}