<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ThrottleLoginAttempts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $key = 'login-attempts:' . $request->ip();

        // Set the rate limit: 5 attempts per minute
        $maxAttempts = 5;
        $decayMinutes = 1;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return redirect()->route('login')->with('error', 'Terlalu Banyak yang Login. Silahkan Coba Beberapa Saat Lagi.');
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        return $next($request);
    }
}
