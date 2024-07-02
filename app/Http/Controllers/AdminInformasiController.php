<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use Illuminate\Support\Facades\Storage;

class AdminInformasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Informasi::query(); 

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $informations = $query->paginate(10);
        return view('admin.informasi.index', compact('informations'));
    }

    public function home()
    {
        $informations = Informasi::orderBy('created_at', 'desc')->take(3)->get();
        return view('home', compact('informations'));
    }

    public function show($id)
    {
        $information = Informasi::findOrFail($id);
        return view('admin.informasi.show', compact('information'));

        $information = Informasi::findOrFail($id);
        return view('siswa.informasi.show', compact('information'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('gambar_informasi', 'public');
        } else {
            $path = null;
        }

        Informasi::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
        ]);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $information = Informasi::findOrFail($id);
        return view('admin.informasi.edit', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $information = Informasi::findOrFail($id);

        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($information->gambar) {
                Storage::disk('public')->delete($information->gambar);
            }
            $path = $request->file('gambar')->store('gambar_informasi', 'public');
        } else {
            $path = $information->gambar;
        }

        $information->update([
            'nama' => $request->nama ?? $information->nama,
            'deskripsi' => $request->deskripsi ?? $information->deskripsi,
            'gambar' => $path,
        ]);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $information = Informasi::findOrFail($id);
        if ($information->gambar) {
            Storage::disk('public')->delete($information->gambar);
        }
        $information->delete();

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }

    
}
