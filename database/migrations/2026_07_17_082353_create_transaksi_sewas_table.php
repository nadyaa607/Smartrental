<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_sewas', function (Blueprint $table) {
            $table->id();

            // Admin / Staff yang membuat transaksi
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Pelanggan yang menyewa
            $table->foreignId('pelanggan_id')
                ->constrained('pelanggans')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Kode transaksi
            $table->string('kode_transaksi')->unique();

            // Tanggal
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');

            // Total biaya
            $table->decimal('total_harga', 12, 2)->default(0);

            // Status transaksi
            $table->enum('status', [
                'Menunggu',
                'Berjalan',
                'Selesai',
                'Dibatalkan'
            ])->default('Menunggu');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_sewas');
    }
};