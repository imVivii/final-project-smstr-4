<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;

class PendaftaranTableSeeder extends Seeder
{
    public function run()
    {
        Pendaftaran::create([
            'id_user' => 3,
            'id_kursus' => 1,
            'status_pendaftaran' => 'menunggu pembayaran',
            'status_kursus' => 'Belum Aktif',
        ]);

        Pendaftaran::create([
            'id_user' => 3,
            'id_kursus' => 2,
            'status_pendaftaran' => 'berhasil',
            'status_kursus' => 'Aktif',
        ]);
    }
}
