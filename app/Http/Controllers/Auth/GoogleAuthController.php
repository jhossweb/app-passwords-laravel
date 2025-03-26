<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    function redirect() 
    {
        return Socialite::driver('google')->redirect();
    }

    function callback() 
    {
        $userGoogle = Socialite::driver("google")->user();

        $user = User::updateOrCreate([
            'google_id' => $userGoogle->id,
        ], [
            'name' => $userGoogle->name,
            'email' => $userGoogle->email
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }
}
