<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Passwords\PasswordsController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Livewire\Home\HomeComponents;
use App\Livewire\Passwords;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('home');
})->name('home');
Route::get("/passwords", Passwords::class)->name("passwords");

/*
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {
    $userGoogle = Socialite::driver('google')->user();
    
    $user = User::updateOrCreate([
        'google_id' => $userGoogle->id,
    ], [
        'name' => $userGoogle->name,
        'email' => $userGoogle->email
    ]);
    
    Auth::login($user);

    return redirect('/passwords');
});
*/

Route::prefix("google-auth")->group(function () {
    Route::get('/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
    Route::get('/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
