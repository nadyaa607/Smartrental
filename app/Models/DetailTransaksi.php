<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $fillable = [
        'transaksi_sewa_id',
        'unit_rental_id',
        'jumlah_unit',
        'harga_satuan',
        'subtotal',
    ];

    public function transaksiSewa()
    {
        return $this->belongsTo(TransaksiSewa::class, 'transaksi_sewa_id');
}

    public function unitRental()
    {
        return $this->belongsTo(UnitRental::class, 'unit_rental_id');
    }
}
