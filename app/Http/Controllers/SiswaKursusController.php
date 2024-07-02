<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;

class SiswaKursusController extends Controller
{
    // Menampilkan daftar kursus
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kursus = Kursus::when($search, function($query, $search) {
                return $query->where('nama', 'like', "%{$search}%");
            })->paginate(10);

        return view('siswa.kursus.index', compact('kursus'));
    }

    // Menampilkan detail kursus
    public function show($id)
    {
        $kursus = Kursus::findOrFail($id);
        return view('siswa.kursus.show', compact('kursus'));
    }
}
