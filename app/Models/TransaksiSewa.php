<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiSewa extends Model
{
    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'kode_transaksi',
        'tanggal_sewa',
        'tanggal_kembali',
        'total_harga',
        'status',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function denda()
    {
        return $this->hasOne(Denda::class);
    }
}
