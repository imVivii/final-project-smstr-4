<?php

namespace App\Http\Controllers;

use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruPengumpulanTugasController extends Controller
{
    public function index(Request $request)
    {
        $guruId = Auth::id();
        $query = PengumpulanTugas::with(['tugas', 'user'])->whereHas('tugas.kursus', function($q) use ($guruId) {
            $q->where('user_id', $guruId);
        });

        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            })->orWhereHas('tugas', function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%');
            });
        }

        $pengumpulanTugas = $query->paginate(10);

        return view('guru.pengumpulan_tugas.index', compact('pengumpulanTugas'));
    }

    // Menampilkan detail pengumpulan tugas
    public function show($id)
    {
        $pengumpulanTugas = PengumpulanTugas::with('tugas', 'user')->findOrFail($id);
        return view('guru.pengumpulan_tugas.show', compact('pengumpulanTugas'));
    }

}