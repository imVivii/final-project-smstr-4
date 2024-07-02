<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
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

        return redirect()->route('home');
    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Something went wrong, please try again later.');
    }
}

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
