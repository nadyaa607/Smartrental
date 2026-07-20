<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Pelanggan;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke transaksi yang dibuat/diproses oleh user ini (khusus admin).
     */
    public function transaksiSewas()
    {
        return $this->hasMany(TransaksiSewa::class);
    }

    /**
     * Relasi ke data profil pelanggan (khusus user dengan role=pelanggan).
     */
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPelanggan(): bool
    {
        return $this->role === 'pelanggan';
    }
}