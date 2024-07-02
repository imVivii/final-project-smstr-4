<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\User;
use App\Models\KategoriKursus;
use Illuminate\Support\Facades\Storage;

class AdminKursusController extends Controller
{
    public function index(Request $request)
    {
        $query = Kursus::with('guru', 'kategoriKursus');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $kursus = $query->paginate(10);
        return view('admin.kursus.index', compact('kursus'));
    }

    public function create()
    {
        $gurus = User::where('role', 'guru')->get();
        $kategoriKursus = KategoriKursus::all();
        return view('admin.kursus.create', compact('gurus', 'kategoriKursus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'media' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'kategori_kursus_id' => 'nullable|exists:kategori_kursus,id',
        ]);

        $path = $request->file('gambar') ? $request->file('gambar')->store('courses', 'public') : null;

        Kursus::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $path,
            'media' => $request->media,
            'user_id' => $request->user_id,
            'kategori_kursus_id' => $request->kategori_kursus_id,
        ]);

        return redirect()->route('admin.kursus.index')->with('success', 'Kursus berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kursus = Kursus::with('guru', 'kategoriKursus')->findOrFail($id);
        return view('admin.kursus.show', compact('kursus'));
    }

    public function edit($id)
    {
        $kursus = Kursus::findOrFail($id);
        $gurus = User::where('role', 'guru')->get();
        $kategoriKursus = KategoriKursus::all();
        return view('admin.kursus.edit', compact('kursus', 'gurus', 'kategoriKursus'));
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
            'user_id' => 'nullable|exists:users,id',
            'kategori_kursus_id' => 'nullable|exists:kategori_kursus,id',
        ]);

        if ($request->hasFile('gambar')) {
            if ($kursus->gambar) {
                Storage::disk('public')->delete($kursus->gambar);
            }
            $path = $request->file('gambar')->store('courses', 'public');
        } else {
            $path = $kursus->gambar;
        }

        $kursus->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $path,
            'media' => $request->media,
            'user_id' => $request->user_id,
            'kategori_kursus_id' => $request->kategori_kursus_id,
        ]);

        return redirect()->route('admin.kursus.index')->with('success', 'Kursus berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kursus = Kursus::findOrFail($id);

        if ($kursus->gambar) {
            Storage::disk('public')->delete($kursus->gambar);
        }

        $kursus->delete();

        return redirect()->route('admin.kursus.index')->with('success', 'Kursus berhasil dihapus.');
    }

    
}
