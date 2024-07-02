<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;

class PembayaranTableSeeder extends Seeder
{
    public function run()
    {
        Pembayaran::create([
            'id_user' => 3,
            'id_kursus' => 1,
            'jumlah_pembayaran' => 100000,
            'bukti_pembayaran' => 'bukti_pembayaran_1.jpg',
            'status_pembayaran' => 'sedang diperiksa',
        ]);

        Pembayaran::create([
            'id_user' => 3,
            'id_kursus' => 2,
            'jumlah_pembayaran' => 120000,
            'bukti_pembayaran' => 'bukti_pembayaran_2.jpg',
            'status_pembayaran' => 'berhasil',
        ]);
    }
}
