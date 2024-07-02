<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    // Menampilkan profil siswa (Web)
    public function showProfile()
    {
        $user = Auth::user();
        return view('siswa.profile.show', compact('user'));
    }

    // Mengedit profil siswa (Web)
    public function editProfile()
    {
        $user = Auth::user();
        return view('siswa.profile.edit', compact('user'));
    }

    // Memperbarui profil siswa (Web)
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|string|min:8|confirmed',
            'deskripsi' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:15',
            'foto_profil' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
        } else {
            $path = $user->foto_profil;
        }

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'deskripsi' => $request->deskripsi,
            'nomor_hp' => $request->nomor_hp,
            'foto_profil' => $path,
        ]);

        return redirect()->route('siswa.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }

}