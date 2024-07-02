<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'deskripsi',
        'foto_profil',
        'nomor_hp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_user');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_user');
    }

    public function kursus()
    {
        return $this->hasMany(Kursus::class);
    }
}
