<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginGitHubController extends Controller
{
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $github_user = Socialite::driver('github')->user();

        $user_exits = User::select()->where('email', $github_user->email)->first();
        dd($user_exits);
        if ($user_exits) {
            Auth::login($user_exits);
            session(['hora' => date('H:i:s')]);
            return to_route('home');
        } else {
            $user_new = User::updateOrCreate([
                'name' => $github_user->name,
                'email' => $github_user->email,
                'role' => 1,
                'external_id' => $github_user->id,
                'external_auth' => 'github',
            ]);

            Auth::login($user_new);
            session(['hora' => date('H:i:s')]);
            return to_route('home');
        }
    }
}
