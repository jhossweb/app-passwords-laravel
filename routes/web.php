<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Passwords\PasswordsController;
use Illuminate\Support\Facades\Route;

Route::get("/", [PasswordsController::class, 'index']);
Route::get("/generated", [PasswordsController::class, 'create']);

Route::resource("/passwords", PasswordsController::class)->parameters(["passwords" => "passwords"])->middleware('auth');

Route::get("/register", [AuthController::class, 'register'])->name("auth.register");
Route::post("/signup", [AuthController::class, 'signup'])->name("auth.signup");
Route::get('/login', [AuthController::class, 'login'])->name("auth.login");
Route::post("/signin", [AuthController::class, 'signin'])->name("auth.signin");
Route::get("/logout", [AuthController::class, 'logout']);