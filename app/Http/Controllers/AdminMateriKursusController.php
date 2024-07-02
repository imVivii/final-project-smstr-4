<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MateriKursus;
use App\Models\Kursus;

class AdminMateriKursusController extends Controller
{
    public function index(Request $request)
    {
        $query = MateriKursus::with('kursus');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%')
                  ->orWhereHas('kursus', function($query) use ($search) {
                      $query->where('nama', 'like', '%' . $search . '%');
                  });
            });
        }

        $materi = $query->paginate(10);

        return view('admin.materi.index', compact('materi'));
    }

    public function show($id)
    {
        $material = MateriKursus::with('kursus')->findOrFail($id);
        return view('admin.materi.show', compact('material'));
    }

    public function create()
    {
        $kursus = Kursus::all();
        return view('admin.materi.create', compact('kursus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'materi' => 'nullable|string',
            'id_kursus' => 'required|exists:kursus,id',
        ]);

        MateriKursus::create($request->all());

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dibuat.');
    }

    public function edit($id)
    {
        $material = MateriKursus::findOrFail($id);
        $kursus = Kursus::all();
        return view('admin.materi.edit', compact('material', 'kursus'));
    }

    public function update(Request $request, $id)
    {
        $material = MateriKursus::findOrFail($id);

        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'materi' => 'nullable|string',
            'id_kursus' => 'required|exists:kursus,id',
        ]);

        $material->update($request->all());

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $material = MateriKursus::findOrFail($id);
        $material->delete();

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
    }

    
}
