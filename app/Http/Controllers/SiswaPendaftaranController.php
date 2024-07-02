<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class SiswaPendaftaranController extends Controller
{
    // Menampilkan daftar pendaftaran kursus
    public function index(Request $request)
    {
        $userId = Auth::id();
        $query = Pendaftaran::where('id_user', $userId);

        if ($request->filled('search')) {
            $query->whereHas('kursus', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $pendaftaran = $query->paginate(10);

        return view('siswa.pendaftaran.index', compact('pendaftaran'));
    }

    // Menampilkan detail pendaftaran
    public function show($id)
    {
        $pendaftaran = Pendaftaran::where('id_user', Auth::id())->findOrFail($id);
        return view('siswa.pendaftaran.show', compact('pendaftaran'));
    }

    // Menghapus pendaftaran
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::where('id_user', Auth::id())->findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('siswa.pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }

    // Menambahkan pendaftaran kursus
    public function store(Request $request)
    {
        $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        Pendaftaran::create([
            'id_user' => Auth::id(),
            'id_kursus' => $request->kursus_id,
            'status_kursus' => 'Belum Aktif',
        ]);

        return redirect()->route('siswa.pendaftaran.index')->with('success', 'Pendaftaran berhasil.');
    }

}