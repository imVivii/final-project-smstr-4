<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Informasi;

class InformasiTableSeeder extends Seeder
{
    public function run()
    {
        Informasi::create([
            'nama' => 'Pengumuman 1',
            'deskripsi' => 'Pengumuman penting tentang kursus',
            'gambar' => 'pengumuman_1.jpg',
        ]);

        Informasi::create([
            'nama' => 'Pengumuman 2',
            'deskripsi' => 'Pengumuman penting tentang kursus',
            'gambar' => 'pengumuman_2.jpg',
        ]);
    }
}
