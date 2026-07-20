<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'user_id',
        'kode_pelanggan',
        'nama',
        'email',
        'telepon',
        'alamat',
        'no_identitas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}