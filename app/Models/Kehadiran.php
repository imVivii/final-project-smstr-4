<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran';

    protected $fillable = [
        'user_id',
        'kursus_id',
        'tanggal',
    ];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isiKehadiran()
    {
        return $this->hasMany(IsiKehadiran::class, 'kehadiran_id');
    }

   
}
