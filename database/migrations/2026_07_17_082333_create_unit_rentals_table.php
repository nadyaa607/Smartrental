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
        Schema::create('unit_rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->constrained('kategori_units')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('kode_unit')->unique();
            $table->string('nama_unit');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_sewa', 12, 2);
            $table->integer('stok')->default(1);
            $table->enum('status', [
                'tersedia',
                'disewa',
                'maintenance'
            ])->default('tersedia');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_rentals');
    }
};