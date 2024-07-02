<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class SiswaTugasController extends Controller
{
    // Menampilkan daftar tugas yang dimiliki siswa (Web)
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Pendaftaran::where('id_user', $userId)
                    ->where('status_kursus', 'Aktif')
                    ->with('kursus.tugas');

        if ($request->filled('search')) {
            $query->whereHas('kursus', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        $registrations = $query->paginate(10);

        return view('siswa.tugas.index', compact('registrations'));
    }

    // Menampilkan detail tugas (Web)
    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('siswa.tugas.show', compact('tugas'));
    }

}
