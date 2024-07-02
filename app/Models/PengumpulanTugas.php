<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;

    protected $fillable = ['tugas_id', 'user_id', 'file_path'];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class, 'tugas_id');
    }

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }

}
