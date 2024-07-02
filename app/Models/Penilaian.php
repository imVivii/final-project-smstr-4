<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = ['pengumpulan_tugas_id', 'guru_id', 'nilai', 'komentar'];

    protected $table = 'penilaian';

    public function pengumpulanTugas()
    {
        return $this->belongsTo(PengumpulanTugas::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
