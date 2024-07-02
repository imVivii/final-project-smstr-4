<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'deskripsi', 'harga', 'gambar', 'media', 'user_id', 'kategori_kursus_id'
    ];

    protected $table = 'kursus';

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function materiKursus()
    {
        return $this->hasMany(MateriKursus::class, 'id_kursus');
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'id_user');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'id_kursus');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_kursus');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function kategoriKursus()
    {
        return $this->belongsTo(KategoriKursus::class, 'kategori_kursus_id');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'kursus_id');
    }

    public function siswa()
    {
        return $this->belongsToMany(User::class, 'kursus_user', 'kursus_id', 'user_id')->where('role', 'siswa');
    }



}
