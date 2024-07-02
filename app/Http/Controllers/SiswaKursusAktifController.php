<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class SiswaKursusAktifController extends Controller
{
    // Menampilkan daftar kursus yang dimiliki siswa
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

        $pendaftaran = $query->paginate(10); // Pastikan menggunakan paginate

        return view('siswa.kursus_saya.index', compact('pendaftaran'));
    }

    // Menampilkan detail kursus
    public function show($id)
    {
        $kursus = Pendaftaran::where('id_user', Auth::id())
            ->where('id_kursus', $id)
            ->where('status_kursus', 'Aktif')
            ->firstOrFail();

        return view('siswa.kursus_saya.show', compact('kursus'));
    }
}
