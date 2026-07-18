<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'transaksi_sewa_id',
        'jumlah_bayar',
        'tanggal_bayar',
        'metode_bayar',
        'status_bayar',
        'bukti_bayar',
    ];

    public function transaksiSewa()
    {
        return $this->belongsTo(TransaksiSewa::class, 'transaksi_sewa_id');
    }
}
