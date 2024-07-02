<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kursus;
use App\Models\KategoriKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('role', 'like', "%{$search}%");
        })->paginate(12);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,guru,siswa',
            'deskripsi' => 'nullable|string',
            'nomor_hp' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $data['foto_profil'] = $path;
        }

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,guru,siswa',
            'deskripsi' => 'nullable|string',
            'nomor_hp' => 'nullable|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil && file_exists(storage_path('app/public/' . $user->foto_profil))) {
                \Storage::delete('public/' . $user->foto_profil);
            }
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $data['foto_profil'] = $path;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->foto_profil && file_exists(storage_path('app/public/' . $user->foto_profil))) {
            \Storage::delete('public/' . $user->foto_profil);
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

     public function welcome()
    {
        // Ambil data guru dari tabel users (misal, role 'guru')
        $gurus = User::where('role', 'guru')->with('kursus')->get();

        // Ambil data kursus dari tabel kursus
        $kursus = Kursus::with('KategoriKursus')->get();

        return view('welcome', compact('gurus', 'kursus'));
    }

}