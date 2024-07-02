<?php

namespace App\Http\Controllers;

use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPengumpulanTugasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pengumpulanTugas = PengumpulanTugas::with(['tugas', 'user'])
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('tugas', function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                })->orWhereHas('user', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.pengumpulanTugas.index', compact('pengumpulanTugas'));
    }

    public function create()
    {
        $tugas = Tugas::all();
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.pengumpulanTugas.create', compact('tugas', 'siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'user_id' => 'required|exists:users,id',
            'file_path' => 'required|file|mimes:pdf,doc,docx,zip',
        ]);

        $path = $request->file('file_path')->store('pengumpulan_tugas', 'public');

        PengumpulanTugas::create([
            'tugas_id' => $request->tugas_id,
            'user_id' => $request->user_id,
            'file_path' => $path,
        ]);

        return redirect()->route('admin.pengumpulanTugas.index')->with('success', 'Pengumpulan tugas berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pengumpulanTugas = PengumpulanTugas::with(['tugas', 'user'])->findOrFail($id);
        return view('admin.pengumpulanTugas.show', compact('pengumpulanTugas'));
    }

    public function edit($id)
    {
        $pengumpulanTugas = PengumpulanTugas::findOrFail($id);
        $tugas = Tugas::all();
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.pengumpulanTugas.edit', compact('pengumpulanTugas', 'tugas', 'siswa'));
    }

    public function update(Request $request, $id)
    {
        $pengumpulanTugas = PengumpulanTugas::findOrFail($id);

        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'user_id' => 'required|exists:users,id',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,zip',
        ]);

        if ($request->hasFile('file_path')) {
            if ($pengumpulanTugas->file_path && file_exists(storage_path('app/public/' . $pengumpulanTugas->file_path))) {
                \Storage::delete('public/' . $pengumpulanTugas->file_path);
            }
            $path = $request->file('file_path')->store('pengumpulan_tugas', 'public');
            $pengumpulanTugas->file_path = $path;
        }

        $pengumpulanTugas->update([
            'tugas_id' => $request->tugas_id,
            'user_id' => $request->user_id,
            'file_path' => $pengumpulanTugas->file_path,
        ]);

        return redirect()->route('admin.pengumpulanTugas.index')->with('success', 'Pengumpulan tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengumpulanTugas = PengumpulanTugas::findOrFail($id);

        if ($pengumpulanTugas->file_path && file_exists(storage_path('app/public/' . $pengumpulanTugas->file_path))) {
            \Storage::delete('public/' . $pengumpulanTugas->file_path);
        }

        $pengumpulanTugas->delete();

        return redirect()->route('admin.pengumpulanTugas.index')->with('success', 'Pengumpulan tugas berhasil dihapus.');
    }

}