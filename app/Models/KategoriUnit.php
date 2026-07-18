<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriUnit extends Model
{
    protected $fillable = ['nama_kategori','deskripsi',];

    public function units()
    {
        return $this->hasMany(Unit::class, 'kategori_unit_id');
    }
}
