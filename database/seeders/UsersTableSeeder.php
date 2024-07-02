<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'deskripsi' => 'S2',
            'foto_profil' => 'admin.jpg',
            'nomor_hp' => '123456789',
        ]);

        User::create([
            'nama' => 'Guru User',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'deskripsi' => 'S1',
            'foto_profil' => 'guru.jpg',
            'nomor_hp' => '123456789',
        ]);

        User::create([
            'nama' => 'Siswa User',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'deskripsi' => 'SMA',
            'foto_profil' => 'siswa.jpg',
            'nomor_hp' => '123456789',
        ]);
    }
}
