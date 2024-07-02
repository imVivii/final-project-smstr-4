<?php

namespace App\Http\Controllers;

use App\Models\KategoriKursus;
use Illuminate\Http\Request;

class AdminKategoriKursusController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $kategoriKursus = KategoriKursus::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.kategoriKursus.index', compact('kategoriKursus'));
    }

    public function create()
    {
        return view('admin.kategoriKursus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        KategoriKursus::create($request->all());

        return redirect()->route('admin.kategoriKursus.index')->with('success', 'Kategori Kursus berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kategori = KategoriKursus::findOrFail($id);
        return view('admin.kategoriKursus.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = KategoriKursus::findOrFail($id);
        return view('admin.kategoriKursus.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategori = KategoriKursus::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('admin.kategoriKursus.index')->with('success', 'Kategori Kursus berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kategori = KategoriKursus::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategoriKursus.index')->with('success', 'Kategori Kursus berhasil dihapus.');
    }

    
}
