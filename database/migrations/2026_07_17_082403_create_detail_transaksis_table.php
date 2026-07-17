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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_sewa_id')
                ->constrained('transaksi_sewas')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('unit_rental_id')
                ->constrained('unit_rentals')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('jumlah')->default(1);
            $table->decimal('harga', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};