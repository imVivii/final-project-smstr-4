<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\IsiKehadiran;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SiswaIsiKehadiranController extends Controller
{
    // Menampilkan daftar kehadiran yang sudah diisi oleh siswa (Web)
    public function index()
    {
        $userId = Auth::id();
        $isiKehadiran = IsiKehadiran::where('user_id', $userId)->with('kehadiran.kursus')->paginate(10);

        return view('siswa.isi_kehadiran.index', compact('isiKehadiran'));
    }

    // Menampilkan form untuk mengisi kehadiran (Web)
    public function create($kehadiran_id)
    {
        $kehadiran = Kehadiran::with('kursus')->findOrFail($kehadiran_id);

        // Cek apakah siswa sudah mengisi kehadiran
        $existing = IsiKehadiran::where('kehadiran_id', $kehadiran_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            return redirect()->route('siswa.kehadiran.index')->with('error', 'Anda sudah mengisi kehadiran untuk kursus ini.');
        }

        // Cek apakah tanggal kehadiran adalah hari ini
        if (!Carbon::parse($kehadiran->tanggal)->isToday()) {
            return redirect()->route('siswa.kehadiran.index')->with('error', 'Anda hanya bisa mengisi kehadiran pada hari ini.');
        }

        return view('siswa.isi_kehadiran.create', compact('kehadiran'));
    }

    // Menyimpan data kehadiran yang diisi oleh siswa (Web)
    public function store(Request $request)
    {
        $request->validate([
            'kehadiran_id' => 'required|exists:kehadiran,id',
            'status' => 'required|in:hadir,tidak hadir',
        ]);

        $kehadiran = Kehadiran::findOrFail($request->kehadiran_id);

        // Cek apakah tanggal kehadiran adalah hari ini
        if (!Carbon::parse($kehadiran->tanggal)->isToday()) {
            return redirect()->route('siswa.kehadiran.index')->with('error', 'Anda hanya bisa mengisi kehadiran pada hari ini.');
        }

        $userId = Auth::id();

        IsiKehadiran::create([
            'kehadiran_id' => $request->kehadiran_id,
            'user_id' => $userId,
            'status' => $request->status,
        ]);

        return redirect()->route('siswa.kehadiran.index')->with('success', 'Kehadiran berhasil diisi.');
    }

    // Menampilkan detail kehadiran (Web)
    public function show($id)
    {
        $kehadiran = Kehadiran::with(['kursus', 'isiKehadiran' => function($query) {
            $query->where('user_id', Auth::id());
        }])->findOrFail($id);

        return view('siswa.isi_kehadiran.show', compact('kehadiran'));
    }
}
