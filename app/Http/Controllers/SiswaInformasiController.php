<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class SiswaInformasiController extends Controller
{
    // Menampilkan daftar informasi (Web)
    public function index(Request $request)
    {
        $query = Informasi::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $informations = $query->paginate(10);
        return view('siswa.informasi.index', compact('informations'));
    }

    // Menampilkan detail informasi (Web)
    public function show($id)
    {
        $information = Informasi::findOrFail($id);
        return view('siswa.informasi.show', compact('information'));
    }

}