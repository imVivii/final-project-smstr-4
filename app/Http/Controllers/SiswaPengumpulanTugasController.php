<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiswaPengumpulanTugasController extends Controller
{
    // Menampilkan daftar pengumpulan tugas (Web)
    public function index()
    {
        $userId = Auth::id();
        $pengumpulanTugas = PengumpulanTugas::where('user_id', $userId)->with('tugas')->paginate(10);

        return view('siswa.pengumpulan_tugas.index', compact('pengumpulanTugas'));
    }

    
    // Menampilkan form untuk membuat pengumpulan tugas baru (Web)
    public function create($tugas_id)
    {
        $tugas = Tugas::findOrFail($tugas_id);

        // Cek apakah sudah melewati deadline
        if (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($tugas->tanggal_deadline))) {
            return redirect()->route('siswa.tugas.index')->with('error', 'Anda tidak dapat mengirim tugas ini karena sudah melewati deadline.');
        }

        // Cek apakah sudah ada tugas yang dikumpulkan
        $existingPengumpulan = PengumpulanTugas::where('tugas_id', $tugas_id)->where('user_id', Auth::id())->first();
        if ($existingPengumpulan) {
            return redirect()->route('siswa.tugas.index')->with('error', 'Anda sudah mengirim tugas ini.');
        }

        return view('siswa.pengumpulan_tugas.create', compact('tugas'));
    }

    // Menyimpan pengumpulan tugas baru (Web)
    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'file_path' => 'required|file|mimes:pdf,doc,docx,zip'
        ]);

        $tugas = Tugas::findOrFail($request->tugas_id);

        // Cek apakah sudah melewati deadline
        if (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($tugas->tanggal_deadline))) {
            return redirect()->route('siswa.tugas.index')->with('error', 'Anda tidak dapat mengirim tugas ini karena sudah melewati deadline.');
        }

        $filePath = $request->file('file_path')->store('pengumpulan_tugas', 'public');

        PengumpulanTugas::create([
            'tugas_id' => $request->tugas_id,
            'user_id' => Auth::id(),
            'file_path' => $filePath
        ]);

        return redirect()->route('siswa.pengumpulan_tugas.index')->with('success', 'Tugas berhasil dikirim.');
    }

    
    // Menampilkan detail pengumpulan tugas (Web)
    public function show($id)
    {
        $pengumpulanTugas = PengumpulanTugas::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('siswa.pengumpulan_tugas.show', compact('pengumpulanTugas'));
    }

    
    // Menampilkan form untuk mengedit pengumpulan tugas (Web)
    public function edit($id)
    {
        $pengumpulanTugas = PengumpulanTugas::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $tugas = $pengumpulanTugas->tugas;

        // Cek apakah sudah melewati deadline
        if (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($tugas->tanggal_deadline))) {
            return redirect()->route('siswa.pengumpulan_tugas.index')->with('error', 'Anda tidak dapat mengedit tugas ini karena sudah melewati deadline.');
        }

        return view('siswa.pengumpulan_tugas.edit', compact('pengumpulanTugas', 'tugas'));
    }

    // Memperbarui pengumpulan tugas (Web)
    public function update(Request $request, $id)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,zip'
        ]);

        $pengumpulanTugas = PengumpulanTugas::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $tugas = $pengumpulanTugas->tugas;

        // Cek apakah sudah melewati deadline
        if (\Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($tugas->tanggal_deadline))) {
            return redirect()->route('siswa.pengumpulan_tugas.index')->with('error', 'Anda tidak dapat mengedit tugas ini karena sudah melewati deadline.');
        }

        if ($request->hasFile('file_path')) {
            // Hapus file lama jika ada
            if ($pengumpulanTugas->file_path) {
                Storage::disk('public')->delete($pengumpulanTugas->file_path);
            }
            $filePath = $request->file('file_path')->store('pengumpulan_tugas', 'public');
        } else {
            $filePath = $pengumpulanTugas->file_path;
        }

        $pengumpulanTugas->update([
            'tugas_id' => $request->tugas_id,
            'file_path' => $filePath
        ]);

        return redirect()->route('siswa.pengumpulan_tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

   
}
