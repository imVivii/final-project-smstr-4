<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'id_user', 'id_kursus', 'jumlah_pembayaran', 'bukti_pembayaran', 'status_pembayaran',
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id_kursus');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

   
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_kursus', 'id_kursus');
    }
}
