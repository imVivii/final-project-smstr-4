<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Auth;

class SiswaPenilaianController extends Controller
{
    // Menampilkan daftar penilaian (Web)
    public function index()
    {
        $userId = Auth::id();
        $penilaian = Penilaian::whereHas('pengumpulanTugas', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['pengumpulanTugas.tugas.kursus'])->paginate(10);

        return view('siswa.penilaian.index', compact('penilaian'));
    }

    

    // Menampilkan detail penilaian (Web)
    public function show($id)
    {
        $userId = Auth::id();
        $penilaian = Penilaian::whereHas('pengumpulanTugas', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['pengumpulanTugas.tugas.kursus'])->findOrFail($id);

        return view('siswa.penilaian.show', compact('penilaian'));
    }

   
}
