<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MateriKursus;

class MateriKursusTableSeeder extends Seeder
{
    public function run()
    {
        MateriKursus::create([
            'nama' => 'Pengenalan Laravel',
            'deskripsi' => 'Materi pengenalan framework Laravel',
            'materi' => 'Intro to Laravel',
            'id_kursus' => 1,
        ]);

        MateriKursus::create([
            'nama' => 'Pengenalan Vue.js',
            'deskripsi' => 'Materi pengenalan framework Vue.js',
            'materi' => 'Intro to Vue.js',
            'id_kursus' => 2,
        ]);
    }
}
