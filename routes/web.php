<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Passwords\PasswordsController;
use App\Livewire\Home\HomeComponents;
use App\Livewire\Passwords;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;
use Laravel\Socialite\Facades\Socialite;
/*
Route::get("/", [PasswordsController::class, 'index']);
Route::get("/generated", [PasswordsController::class, 'create']);

Route::resource("/passwords", PasswordsController::class)->parameters(["passwords" => "passwords"])->middleware('auth');

Route::get("/register", [AuthController::class, 'register'])->name("auth.register");
Route::post("/signup", [AuthController::class, 'signup'])->name("auth.signup");
Route::get('/login', [AuthController::class, 'login'])->name("auth.login");
Route::post("/signin", [AuthController::class, 'signin'])->name("auth.signin");
Route::get("/logout", [AuthController::class, 'logout']);*/

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get("/passwords", Passwords::class)->name("passwords");


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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
