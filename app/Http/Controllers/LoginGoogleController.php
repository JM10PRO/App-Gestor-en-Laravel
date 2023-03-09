<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $google_user = Socialite::driver('google')->user();

        $user_exits = User::select()->where('email', $google_user->email)->where('external_auth', 'google')->first();
        
        if ($user_exits) {
            Auth::login($user_exits);
            session(['hora' => date('H:i:s')]);
            return to_route('home');
        } else {
            $user_new = User::updateOrCreate([
                'name' => $google_user->name,
                'email' => $google_user->email,
                'role' => 1,
                'external_id' => $google_user->id,
                'external_auth' => 'google',
            ]);

            Auth::login($user_new);
            session(['hora' => date('H:i:s')]);
            return to_route('home');
        }
    }
}
