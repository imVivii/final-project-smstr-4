<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Carbon\Carbon;

class ApiLoginController extends Controller
{public function login(Request $request)
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
                'name' => $user->name,
                'role' => $user->role,
                'iat' => Carbon::now()->timestamp,
                'exp' => Carbon::now()->timestamp + 60 * 60 * 2,
            ];

            $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

            return response()->json([
                'msg' => 'token berhasil dibuat',
                'data' => 'Bearer ' . $token
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Email atau Password Salah',
            ], 422);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logout berhasil'], 200);
    }
}
