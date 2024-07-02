<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Kursus;
use Illuminate\Http\Request;

class AdminTugasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $tugas = Tugas::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', "%{$search}%")
                         ->orWhereHas('kursus', function ($q) use ($search) {
                             $q->where('nama', 'like', "%{$search}%");
                         });
        })->paginate(10);

        return view('admin.tugas.index', compact('tugas'));
    }

    public function create()
    {
        $kursus = Kursus::all();
        return view('admin.tugas.create', compact('kursus'));
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

        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('admin.tugas.show', compact('tugas'));
    }

    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        $kursus = Kursus::all();
        return view('admin.tugas.edit', compact('tugas', 'kursus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_deadline' => 'required|date',
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        $tugas = Tugas::findOrFail($id);
        $tugas->update($request->all());

        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil diupdate.');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

}