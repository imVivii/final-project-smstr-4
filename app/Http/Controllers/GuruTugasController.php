<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruTugasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $guru_id = Auth::id();

        $tugas = Tugas::with('kursus')
            ->whereHas('kursus', function ($query) use ($guru_id) {
                $query->where('user_id', $guru_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('guru.tugas.index', compact('tugas'));
    }

    public function create()
    {
        $guru_id = Auth::id();
        $kursus = Kursus::where('user_id', $guru_id)->get();

        return view('guru.tugas.create', compact('kursus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_deadline' => 'required|date',
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        Tugas::create($request->all());

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show($id)
    {
        $tugas = Tugas::with('kursus')->findOrFail($id);

        return view('guru.tugas.show', compact('tugas'));
    }

    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        $guru_id = Auth::id();
        $kursus = Kursus::where('user_id', $guru_id)->get();

        return view('guru.tugas.edit', compact('tugas', 'kursus'));
    }

    public function update(Request $request, $id)
    {
        $tugas = Tugas::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_deadline' => 'required|date',
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        $tugas->update($request->all());

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

}