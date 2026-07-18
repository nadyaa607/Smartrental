<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $fillable = [
        'transaksi_sewa_id',
        'jumlah_hari_terlambat',
        'jumlah_denda',
        'keterangan',
    ];

    public function transaksiSewa()
    {
        return $this->belongsTo(TransaksiSewa::class, 'transaksi_sewa_id');
    }
}
