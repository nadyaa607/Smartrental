<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware(['auth'])->group(function () {

    // Dashboard tunggal — kontennya otomatis menyesuaikan role (lihat DashboardController)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ===== Rute khusus ADMIN =====
    // Middleware 'role:admin' memastikan hanya user dengan role admin yang bisa masuk.
    // Route modul (Manajemen Barang, Pelanggan, Transaksi, dst) akan ditambahkan
    // secara bertahap mulai Tahap 3.
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Route::resource('barang', UnitRentalController::class); // Tahap 3
        // Route::resource('pelanggan', PelangganController::class); // Tahap 4
        // Route::resource('transaksi', TransaksiSewaController::class); // Tahap 5
        // dst — akan diisi pada tahap selanjutnya
    });

    // ===== Rute khusus PELANGGAN =====
    Route::middleware(['role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
        // Route::get('katalog', [KatalogController::class, 'index']); // Tahap 9-10
        // dst — akan diisi pada tahap selanjutnya
    });
});

require __DIR__.'/auth.php';