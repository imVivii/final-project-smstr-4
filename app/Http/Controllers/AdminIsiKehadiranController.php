<?php

namespace App\Http\Controllers;

use App\Models\IsiKehadiran;
use App\Models\Kehadiran;
use App\Models\User;
use Illuminate\Http\Request;

class AdminIsiKehadiranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $isiKehadiran = IsiKehadiran::with('kehadiran.kursus', 'user')
            ->when($search, function($query) use ($search) {
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('kehadiran.kursus', function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.isi_kehadiran.index', compact('isiKehadiran'));
    }

    public function create()
    {
        $kehadiran = Kehadiran::with('kursus')->get();
        $users = User::where('role', 'siswa')->get();

        return view('admin.isi_kehadiran.create', compact('kehadiran', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kehadiran_id' => 'required|exists:kehadiran,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:hadir,tidak hadir',
        ]);

        IsiKehadiran::create($request->all());

        return redirect()->route('admin.isi_kehadiran.index')->with('success', 'Data kehadiran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kehadiran = IsiKehadiran::with('kehadiran.kursus', 'user')->findOrFail($id);

        return view('admin.isi_kehadiran.show', compact('kehadiran'));
    }

    public function edit($id)
    {
        $kehadiran = IsiKehadiran::findOrFail($id);
        $allKehadiran = Kehadiran::with('kursus')->get();
        $users = User::where('role', 'siswa')->get();

        return view('admin.isi_kehadiran.edit', compact('kehadiran', 'allKehadiran', 'users'));
    }

    public function update(Request $request, $id)
    {
        $kehadiran = IsiKehadiran::findOrFail($id);

        $request->validate([
            'kehadiran_id' => 'required|exists:kehadiran,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:hadir,tidak hadir',
        ]);

        $kehadiran->update($request->all());

        return redirect()->route('admin.isi_kehadiran.index')->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kehadiran = IsiKehadiran::findOrFail($id);
        $kehadiran->delete();

        return redirect()->route('admin.isi_kehadiran.index')->with('success', 'Data kehadiran berhasil dihapus.');
    }

    
}
