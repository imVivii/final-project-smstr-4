<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\User;
use App\Models\KategoriKursus;

class HomeController extends Controller
{
    public function getKursus()
    {
        $kursus = Kursus::all();
        foreach ($kursus as $k) {
            $k->gambar = url('storage/'.$k->gambar);
        }
        return response()->json($kursus);
    }

    public function getGuru()
    {
        $guru = User::where('role', 'guru')->get();
        foreach ($guru as $g) {
            $g->foto_profil = url('storage/'.$g->foto_profil);
        }
        return response()->json($guru);
    }

    public function getKategoriKursus()
    {
        $kategoriKursus = KategoriKursus::all();
        return response()->json($kategoriKursus);
    }
}
