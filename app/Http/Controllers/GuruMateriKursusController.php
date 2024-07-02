<?php

namespace App\Http\Controllers;

use App\Models\MateriKursus;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruMateriKursusController extends Controller
{
    public function index(Request $request)
    {
        $guru_id = Auth::id();
        $id_kursus = $request->get('id_kursus');
        $search = $request->get('search');

        $query = MateriKursus::with('kursus')
            ->whereHas('kursus', function($query) use ($guru_id) {
                $query->where('user_id', $guru_id);
            });

        if ($id_kursus) {
            $query->where('id_kursus', $id_kursus);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        $materi = $query->paginate(10);
        $all_kursus = Kursus::where('user_id', $guru_id)->get();

        return view('guru.materi.index', compact('materi', 'all_kursus'));
    }

    public function create()
    {
        $kursus = Kursus::where('user_id', Auth::id())->get();
        return view('guru.materi.create', compact('kursus'));
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

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $materi = MateriKursus::with('kursus')->findOrFail($id);
        return view('guru.materi.show', compact('materi'));
    }

    public function edit($id)
    {
        $materi = MateriKursus::findOrFail($id);
        $kursus = Kursus::where('user_id', Auth::id())->get();
        return view('guru.materi.edit', compact('materi', 'kursus'));
    }

    public function update(Request $request, $id)
    {
        $materi = MateriKursus::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'materi' => 'nullable|string',
            'id_kursus' => 'required|exists:kursus,id',
        ]);

        $materi->update($request->all());

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $materi = MateriKursus::findOrFail($id);
        $materi->delete();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus.');
    }

}