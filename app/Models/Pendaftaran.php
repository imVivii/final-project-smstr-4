<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'id_user',
        'id_kursus',
        'status_pendaftaran',
        'status_kursus',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id_kursus');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_kursus', 'id_kursus')
            ->where('id_user', $this->id_user);
    }

    public function getStatusPembayaranAttribute()
    {
        $pembayaran = $this->pembayaran()->orderBy('created_at', 'desc')->first();
        return $pembayaran ? $pembayaran->status_pembayaran : 'menunggu pembayaran';
    }
}
