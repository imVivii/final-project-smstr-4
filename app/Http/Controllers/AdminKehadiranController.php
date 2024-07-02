<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\IsiKehadiran;
use App\Models\Kursus;
use Illuminate\Http\Request;

class AdminKehadiranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $kehadiran = Kehadiran::with('kursus')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('kursus', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.kehadiran.index', compact('kehadiran'));
    }

    public function create()
    {
        $kursus = Kursus::all();
        return view('admin.kehadiran.create', compact('kursus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'tanggal' => 'required|date',
        ]);

        Kehadiran::create($request->all());

        return redirect()->route('admin.kehadiran.index')->with('success', 'Kehadiran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kehadiran = Kehadiran::with('kursus')->findOrFail($id);
        $isiKehadiran = IsiKehadiran::where('kehadiran_id', $id)->with('user')->get();

        return view('admin.kehadiran.show', compact('kehadiran', 'isiKehadiran'));
    }

    public function edit($id)
    {
        $kehadiran = Kehadiran::findOrFail($id);
        $kursus = Kursus::all();

        return view('admin.kehadiran.edit', compact('kehadiran', 'kursus'));
    }

    public function update(Request $request, $id)
    {
        $kehadiran = Kehadiran::findOrFail($id);

        $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'tanggal' => 'required|date',
        ]);

        $kehadiran->update($request->all());

        return redirect()->route('admin.kehadiran.index')->with('success', 'Kehadiran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kehadiran = Kehadiran::findOrFail($id);
        $kehadiran->delete();

        return redirect()->route('admin.kehadiran.index')->with('success', 'Kehadiran berhasil dihapus.');
    }

}
