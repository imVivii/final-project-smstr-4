<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\PengumpulanTugas;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPenilaianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $penilaian = Penilaian::with(['pengumpulanTugas.tugas', 'guru'])
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('pengumpulanTugas.tugas', function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                })->orWhereHas('guru', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.penilaian.index', compact('penilaian'));
    }

    public function create()
    {
        $pengumpulanTugas = PengumpulanTugas::all();
        $gurus = User::where('role', 'guru')->get();
        return view('admin.penilaian.create', compact('pengumpulanTugas', 'gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pengumpulan_tugas_id' => 'required|exists:pengumpulan_tugas,id',
            'guru_id' => 'required|exists:users,id',
            'nilai' => 'required|integer',
            'komentar' => 'nullable|string',
        ]);

        Penilaian::create($request->all());

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function show($id)
    {
        $penilaian = Penilaian::with(['pengumpulanTugas.tugas', 'guru'])->findOrFail($id);
        return view('admin.penilaian.show', compact('penilaian'));
    }

    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $pengumpulanTugas = PengumpulanTugas::all();
        $gurus = User::where('role', 'guru')->get();
        return view('admin.penilaian.edit', compact('penilaian', 'pengumpulanTugas', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pengumpulan_tugas_id' => 'required|exists:pengumpulan_tugas,id',
            'guru_id' => 'required|exists:users,id',
            'nilai' => 'required|integer',
            'komentar' => 'nullable|string',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $penilaian->update($request->all());

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil diupdate.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }

}