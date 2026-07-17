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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transaksi_sewa_id')
                ->constrained('transaksi_sewas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->date('tanggal_bayar');

            $table->decimal('jumlah_bayar', 12, 2);

            $table->enum('metode_pembayaran', [
                'Cash',
                'Transfer',
                'QRIS'
            ]);

            $table->enum('status', [
                'Belum Lunas',
                'Lunas'
            ])->default('Belum Lunas');

            $table->string('bukti_pembayaran')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};