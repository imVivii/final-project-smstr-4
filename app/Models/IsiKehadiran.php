<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsiKehadiran extends Model
{
    use HasFactory;

    protected $table = 'isi_kehadiran';

    protected $fillable = [
        'kehadiran_id', 
        'user_id', 
        'status'
    ];

    public function kehadiran()
    {
        return $this->belongsTo(Kehadiran::class, 'kehadiran_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    public function isiKehadiran()
    {
        return $this->hasMany(IsiKehadiran::class, 'kehadiran_id');
    }

}
