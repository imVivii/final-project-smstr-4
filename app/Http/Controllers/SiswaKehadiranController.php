<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;
use Illuminate\Support\Facades\Auth;

class SiswaKehadiranController extends Controller
{
    // Menampilkan daftar kehadiran (Web)
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Kehadiran::with(['kursus', 'isiKehadiran'])->whereHas('kursus.pendaftaran', function($q) use ($userId) {
            $q->where('id_user', $userId)->where('status_kursus', 'Aktif');
        });

        if ($request->filled('search')) {
            $query->whereHas('kursus', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $kehadiran = $query->paginate(10);

        return view('siswa.kehadiran.index', compact('kehadiran'));
    }

    // Menampilkan form untuk mengisi kehadiran (Web)
    public function isi($kehadiran_id)
    {
        $kehadiran = Kehadiran::findOrFail($kehadiran_id);
        return view('siswa.kehadiran.isi', compact('kehadiran'));
    }

}