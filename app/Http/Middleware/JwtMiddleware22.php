<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        try {
            $credentials = JWT::decode($token, new Key(env('JWT_SECRET_KEY'), 'HS256'));
        } catch (Exception $e) {
            return response()->json(['message' => 'Invalid token', 'error' => $e->getMessage()], 401);
        }

        $user = User::find($credentials->sub);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 401);
        }

        Auth::setUser($user);

        return $next($request);
    }
}
