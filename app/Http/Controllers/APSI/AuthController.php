<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $this->createToken($user);

        return response()->json(['token' => $token, 'user' => $user], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = $this->createToken($user);

        return response()->json(['token' => $token, 'user' => $user], 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    private function createToken($user)
    {
        $payload = [
            'iss' => "jwt-auth", // Issuer
            'sub' => $user->id, // Subject (user ID)
            'iat' => time(), // Issued at
            'exp' => time() + 60*60 // Expiration time
        ];

        $key = env('JWT_SECRET_KEY');
        $alg = 'HS256';

        return JWT::encode($payload, $key, $alg);
    }
}
