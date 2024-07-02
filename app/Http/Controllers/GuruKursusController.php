<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\KategoriKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuruKursusController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $guru_id = Auth::id();
        $kursus = Kursus::where('user_id', $guru_id)
            ->when($search, function ($query) use ($search) {
                return $query->where('nama', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('guru.kursus.index', compact('kursus'));
    }

    public function create()
    {
        $kategoriKursus = KategoriKursus::all();
        return view('guru.kursus.create', compact('kategoriKursus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'media' => 'nullable|string',
            'kategori_kursus_id' => 'nullable|exists:kategori_kursus,id',
        ]);

        $path = $request->file('gambar') ? $request->file('gambar')->store('kursus', 'public') : null;

        Kursus::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $path,
            'media' => $request->media,
            'user_id' => Auth::id(),
            'kategori_kursus_id' => $request->kategori_kursus_id,
        ]);

        return redirect()->route('guru.kursus.index')->with('success', 'Kursus berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kursus = Kursus::with(['kategoriKursus', 'pendaftaran.user'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        return view('guru.kursus.show', compact('kursus'));
    }

    public function edit($id)
    {
        $kursus = Kursus::findOrFail($id);
        $kategoriKursus = KategoriKursus::all();
        return view('guru.kursus.edit', compact('kursus', 'kategoriKursus'));
    }

    public function update(Request $request, $id)
    {
        $kursus = Kursus::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'media' => 'nullable|string',
            'kategori_kursus_id' => 'nullable|exists:kategori_kursus,id',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kursus->gambar) {
                Storage::disk('public')->delete($kursus->gambar);
            }
            $path = $request->file('gambar')->store('kursus', 'public');
        } else {
            $path = $kursus->gambar;
        }

        $kursus->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $path,
            'media' => $request->media,
            'kategori_kursus_id' => $request->kategori_kursus_id,
        ]);

        return redirect()->route('guru.kursus.index')->with('success', 'Kursus berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kursus = Kursus::findOrFail($id);

        if ($kursus->gambar) {
            Storage::disk('public')->delete($kursus->gambar);
        }

        $kursus->delete();

        return redirect()->route('guru.kursus.index')->with('success', 'Kursus berhasil dihapus.');
    }
}
