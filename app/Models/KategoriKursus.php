<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKursus extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    protected $table = 'kategori_kursus';

    public function kursus()
    {
        return $this->hasMany(Kursus::class, 'kategori_kursus_id');
    }
}
