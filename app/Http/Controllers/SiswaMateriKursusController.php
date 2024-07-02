<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\MateriKursus;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class SiswaMateriKursusController extends Controller
{
    // Menampilkan daftar kursus yang dimiliki siswa (Web)
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Pendaftaran::where('id_user', $userId)
                    ->where('status_kursus', 'Aktif')
                    ->with('kursus');

        if ($request->filled('search')) {
            $query->whereHas('kursus', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        $registrations = $query->paginate(10);

        return view('siswa.materi.index', compact('registrations'));
    }

    // Menampilkan daftar materi untuk kursus tertentu (Web)
    public function show($id)
    {
        $kursus = Kursus::findOrFail($id);
        $materi = MateriKursus::where('id_kursus', $id)->get();
        return view('siswa.materi.show', compact('kursus', 'materi'));
    }

}