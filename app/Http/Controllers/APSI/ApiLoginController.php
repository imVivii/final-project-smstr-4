<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Carbon\Carbon;

class ApiLoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirectToGoogle()
    {
        $redirectUrl = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return response()->json(['url' => $redirectUrl]);
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                Auth::login($user);
            } else {
                $user = User::create([
                    'nama' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(Str::random(10))
                ]);

                Auth::login($user);
            }

            $payload = [
                'sub' => $user->id,
                'name' => $user->nama,
                'email' => $user->email,
                'role' => $user->role,
                'iat' => Carbon::now()->timestamp,
                'exp' => Carbon::now()->timestamp + 60 * 60 * 2, // Token valid for 2 hours
            ];

            $token = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

            return response()->json([
                'msg' => 'Token berhasil dibuat',
                'token' => 'Bearer ' . $token
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mendapatkan informasi pengguna dari Google', 'error' => $e->getMessage()], 401);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logout berhasil'], 200);
    }
}
