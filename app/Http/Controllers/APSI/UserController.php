<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto_profil' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:15',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'deskripsi' => $request->deskripsi,
            'foto_profil' => $request->foto_profil,
            'nomor_hp' => $request->nomor_hp,
        ]);

        return response()->json($user, 201);
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $request->validate([
                'nama' => 'string|max:255',
                'email' => 'string|email|max:255|unique:users,email,' . $id,
                'password' => 'string|min:6|nullable',
                'role' => 'string|max:255',
                'deskripsi' => 'nullable|string',
                'foto_profil' => 'nullable|string',
                'nomor_hp' => 'nullable|string|max:15',
            ]);

            $user->update([
                'nama' => $request->nama ?? $user->nama,
                'email' => $request->email ?? $user->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'role' => $request->role ?? $user->role,
                'deskripsi' => $request->deskripsi ?? $user->deskripsi,
                'foto_profil' => $request->foto_profil ?? $user->foto_profil,
                'nomor_hp' => $request->nomor_hp ?? $user->nomor_hp,
            ]);

            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
