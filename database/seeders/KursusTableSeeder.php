<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kursus;

class KursusTableSeeder extends Seeder
{
    public function run()
    {
        Kursus::create([
            'nama' => 'Kursus Laravel',
            'deskripsi' => 'Belajar Laravel dari dasar hingga mahir',
            'harga' => 100000,
            'gambar' => 'kursus_laravel.jpg',
        ]);

        Kursus::create([
            'nama' => 'Kursus Vue.js',
            'deskripsi' => 'Belajar Vue.js dari dasar hingga mahir',
            'harga' => 120000,
            'gambar' => 'kursus_vue.jpg',
        ]);
    }
}
