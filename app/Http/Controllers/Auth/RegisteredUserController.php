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
     *
     * Registrasi publik selalu membuat akun dengan role "pelanggan".
     * Role "admin" TIDAK PERNAH bisa dipilih dari form ini — akun admin
     * hanya dibuat lewat Seeder (lihat database/seeders/AdminSeeder.php).
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Memproses registrasi pelanggan baru.
     *
     * Membuat 1 baris di tabel `users` (akun login, role dipaksa "pelanggan")
     * dan 1 baris terkait di tabel `pelanggans` (data profil) sekaligus,
     * dibungkus dalam satu transaksi database supaya konsisten (all or nothing).
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'no_hp' => $validated['telepon'],
                'password' => Hash::make($validated['password']),
                // Role dipaksa "pelanggan" di sini — tidak pernah diambil dari input user.
                'role' => 'pelanggan',
            ]);

            Pelanggan::create([
                'user_id' => $user->id,
                'kode_pelanggan' => $this->generateKodePelanggan(),
                'nama' => $validated['name'],
                'email' => $validated['email'],
                'telepon' => $validated['telepon'],
                'alamat' => $validated['alamat'],
                'no_identitas' => $validated['no_identitas'],
            ]);

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false))
            ->with('success', 'Registrasi berhasil! Selamat datang, '.$user->name.'.');
    }

    /**
     * Membuat kode pelanggan unik dengan format PLG-000001, PLG-000002, dst.
     * Menggunakan lock supaya aman dari race condition saat 2 pendaftaran
     * terjadi bersamaan.
     */
    private function generateKodePelanggan(): string
    {
        $last = Pelanggan::lockForUpdate()->orderByDesc('id')->first();
        $nextNumber = $last ? ((int) substr($last->kode_pelanggan, 4)) + 1 : 1;

        return 'PLG-'.str_pad((string) $nextNumber, 6, '0', STR_PAD_LEFT);
    }
}
