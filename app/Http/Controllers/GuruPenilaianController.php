<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruPenilaianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $guru_id = Auth::id();

        $penilaian = Penilaian::with('pengumpulanTugas.tugas.kursus', 'guru')
            ->where('guru_id', $guru_id)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('pengumpulanTugas.tugas', function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                })->orWhereHas('guru', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('guru.penilaian.index', compact('penilaian'));
    }

    public function create()
    {
        $pengumpulanTugas = PengumpulanTugas::with('tugas')->get();
        
        return view('guru.penilaian.create', compact('pengumpulanTugas'));

        $pengumpulanTugas = PengumpulanTugas::with('tugas.kursus')->findOrFail($request->pengumpulan_tugas_id);
        return view('guru.penilaian.create', compact('pengumpulanTugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengumpulan_tugas_id' => 'required|exists:pengumpulan_tugas,id',
            'nilai' => 'required|integer',
            'komentar' => 'nullable|string',
        ]);

        Penilaian::create([
            'pengumpulan_tugas_id' => $request->pengumpulan_tugas_id,
            'guru_id' => Auth::id(),
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('guru.penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $penilaian = Penilaian::with('pengumpulanTugas.tugas.kursus', 'guru')->findOrFail($id);

        return view('guru.penilaian.show', compact('penilaian'));
    }

    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $pengumpulanTugas = PengumpulanTugas::with('tugas')->get();
        
        return view('guru.penilaian.edit', compact('penilaian', 'pengumpulanTugas'));
    }

    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $request->validate([
            'pengumpulan_tugas_id' => 'required|exists:pengumpulan_tugas,id',
            'nilai' => 'required|integer',
            'komentar' => 'nullable|string',
        ]);

        $penilaian->update([
            'pengumpulan_tugas_id' => $request->pengumpulan_tugas_id,
            'nilai' => $request->nilai,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('guru.penilaian.index')->with('success', 'Penilaian berhasil diupdate.');
    }
    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('guru.penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }

}