<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriKursus extends Model
{
    use HasFactory;

    protected $table = 'materi_kursus';

    protected $fillable = [
        'nama',
        'deskripsi',
        'materi',
        'id_kursus',
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'id_kursus');
    }
    
}
