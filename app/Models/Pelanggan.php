<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'no_identitas',
        'telepon',
        'alamat',
    ];

    /**
     * Relasi ke akun login (users). Nullable — bisa kosong jika
     * data pelanggan diinput manual oleh admin tanpa akun login.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksiSewas()
    {
        return $this->hasMany(TransaksiSewa::class);
    }
}