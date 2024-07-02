<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $payload = [
                'iss' => "jwt-auth",
                'sub' => $user->id,
                'iat' => time(),
                'exp' => time() + 60*60
            ];

            $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

            return response()->json([
                'token' => $token,
                'user' => $user
            ]);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}
