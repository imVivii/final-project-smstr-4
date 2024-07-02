<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'tanggal_deadline', 'kursus_id'];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class, 'tugas_id');
    }

}
