<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Carbon\Carbon;

class ApiUserController extends Controller
{

    public function loginGet()
    {
        return response()->json(['message' => 'Silahkan login terlebih dahulu'], 401);
    }
    // Login user
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $validated = $validator->validated();

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $payload = [
                'sub' => $user->id,
                'name' => $user->nama,
                'role' => $user->role,
                'iat' => Carbon::now()->timestamp,
                'exp' => Carbon::now()->timestamp + 60 * 60 * 2, // Token valid for 2 hours
            ];

            $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

            return response()->json([
                'msg' => 'Token berhasil dibuat',
                'data' => 'Bearer ' . $token
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Email atau Password Salah',
            ], 422);
        }
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logout berhasil'], 200);
    }

    // Get all users
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    // Get a single user by ID
    public function show($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        return response()->json($user, 200);
    }

    // Get a single user by name
    public function showByName($name)
    {
        $user = User::where('nama', 'like', '%' . $name . '%')->first();

        if (is_null($user)) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        return response()->json($user, 200);
    }

    // Create a new user
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,guru,siswa',
            'deskripsi' => 'nullable|string',
            'foto_profil' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:15'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'deskripsi' => $request->deskripsi,
            'foto_profil' => $request->foto_profil,
            'nomor_hp' => $request->nomor_hp
        ]);

        return response()->json(['message' => 'Pengguna berhasil dibuat', 'data' => $user], 201);
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
            'role' => 'sometimes|required|in:admin,guru,siswa',
            'deskripsi' => 'nullable|string',
            'foto_profil' => 'nullable|string',
            'nomor_hp' => 'nullable|string|max:15'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->has('nama')) {
            $user->nama = $request->nama;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->has('role')) {
            $user->role = $request->role;
        }

        if ($request->has('deskripsi')) {
            $user->deskripsi = $request->deskripsi;
        }

        if ($request->has('foto_profil')) {
            $user->foto_profil = $request->foto_profil;
        }

        if ($request->has('nomor_hp')) {
            $user->nomor_hp = $request->nomor_hp;
        }

        $user->save();

        return response()->json(['message' => 'Pengguna berhasil diupdate', 'data' => $user], 200);
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json(['message' => 'Pengguna tidak ditemukan'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Pengguna berhasil dihapus'], 200);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            "nama" => $request->nama,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        if ($user) {
            return response()->json([
                'message' => 'Akun berhasil dibuat',
                'data' => $user
            ], 200);
        }

        return response()->json(['message' => 'Akun gagal dibuat'], 500);


    }
}
