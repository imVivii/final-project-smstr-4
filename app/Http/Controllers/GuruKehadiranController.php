<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\IsiKehadiran;
use App\Models\Kursus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruKehadiranController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $guru_id = Auth::id();

        $query = Kehadiran::with('kursus')
            ->whereHas('kursus', function ($query) use ($guru_id) {
                $query->where('user_id', $guru_id);
            });

        if ($search) {
            $query->whereHas('kursus', function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%");
            });
        }

        $kehadiran = $query->paginate(10);

        return view('guru.kehadiran.index', compact('kehadiran'));
    }

    public function create()
    {
        $kursus = Kursus::all();
        return view('guru.kehadiran.create', compact('kursus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'tanggal' => 'required|date',
        ]);

        // Simpan data kehadiran
        Kehadiran::create([
            'kursus_id' => $request->kursus_id,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('guru.kehadiran.index')->with('success', 'Daftar kehadiran berhasil dibuat.');
    }

    public function show($kursus_id, $tanggal)
    {
        $kehadiran = Kehadiran::where('kursus_id', $kursus_id)->where('tanggal', $tanggal)->firstOrFail();
        $isiKehadiran = IsiKehadiran::with('user')->where('kehadiran_id', $kehadiran->id)->get();

        return view('guru.kehadiran.show', compact('kehadiran', 'isiKehadiran'));
    }

    public function edit($kursus_id, $tanggal)
    {
        $kehadiran = Kehadiran::where('kursus_id', $kursus_id)->where('tanggal', $tanggal)->firstOrFail();
        $guru_id = Auth::id();
        $kursus = Kursus::where('user_id', $guru_id)->get();
        $siswa = User::where('role', 'siswa')->get();
        $isiKehadiran = IsiKehadiran::where('kehadiran_id', $kehadiran->id)->get();

        return view('guru.kehadiran.edit', compact('kehadiran', 'kursus', 'siswa', 'isiKehadiran'));
    }

    public function update(Request $request, $kursus_id, $tanggal)
    {
        $kehadiran = Kehadiran::where('kursus_id', $kursus_id)->where('tanggal', $tanggal)->firstOrFail();

        $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
            'tanggal' => 'required|date',
            'siswa' => 'required|array',
            'siswa.*.user_id' => 'required|exists:users,id',
            'siswa.*.status' => 'required|in:hadir,tidak hadir',
        ]);

        $kehadiran->update([
            'kursus_id' => $request->kursus_id,
            'tanggal' => $request->tanggal,
        ]);

        foreach ($request->siswa as $siswa) {
            $isiKehadiran = IsiKehadiran::where('kehadiran_id', $kehadiran->id)->where('user_id', $siswa['user_id'])->first();
            if ($isiKehadiran) {
                $isiKehadiran->update([
                    'status' => $siswa['status'],
                ]);
            } else {
                IsiKehadiran::create([
                    'kehadiran_id' => $kehadiran->id,
                    'user_id' => $siswa['user_id'],
                    'status' => $siswa['status'],
                ]);
            }
        }

        return redirect()->route('guru.kehadiran.index')->with('success', 'Kehadiran berhasil diupdate.');
    }

    public function destroy($kursus_id, $tanggal)
    {
        $kehadiran = Kehadiran::where('kursus_id', $kursus_id)->where('tanggal', $tanggal)->firstOrFail();
        $kehadiran->delete();

        return redirect()->route('guru.kehadiran.index')->with('success', 'Kehadiran berhasil dihapus.');
    }

}