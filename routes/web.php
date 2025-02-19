<?php

use App\Http\Controllers\Api\Passwords\PasswordsController;
use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get("/", [PasswordsController::class, 'index']);
Route::get("/generated", [PasswordsController::class, 'create']);

Route::resource("/passwords", PasswordsController::class)->parameters(["passwords" => "passwords"]);
