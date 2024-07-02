<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Kursus;

class AdminPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['kursus', 'user']);

        if ($request->filled('search')) {
            $query->whereHas('kursus', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            })->orWhereHas('user', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $registrations = $query->paginate(10);
        return view('admin.pendaftaran.index', compact('registrations'));
    }

    public function create()
    {
        $courses = Kursus::all();
        $users = User::all();
        return view('admin.pendaftaran.create', compact('courses', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kursus' => 'required|exists:kursus,id',

        ]);

        Pendaftaran::create($request->all());

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $registration = Pendaftaran::with(['kursus', 'user'])->findOrFail($id);
        return view('admin.pendaftaran.show', compact('registration'));
    }

    public function edit($id)
    {
        $registration = Pendaftaran::findOrFail($id);
        $courses = Kursus::all();
        $users = User::all();
        return view('admin.pendaftaran.edit', compact('registration', 'courses', 'users'));
    }

    public function update(Request $request, $id)
    {
        $registration = Pendaftaran::findOrFail($id);

        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_kursus' => 'required|exists:kursus,id',
            'status_pendaftaran' => 'required|in:menunggu pembayaran,sedang diperiksa,berhasil,gagal',
            'status_kursus' => 'required|in:Aktif,Belum Aktif',
        ]);

        $registration->update($request->all());

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $registration = Pendaftaran::findOrFail($id);
        $registration->delete();

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
