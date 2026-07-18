<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitRental extends Model
{
    protected $fillable = [
        'kategori_id',
        'kode_unit',
        'nama_unit',
        'deskripsi',
        'harga_sewa',
        'stok',
        'status',
        'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriUnit::class,'kategori_id');
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}