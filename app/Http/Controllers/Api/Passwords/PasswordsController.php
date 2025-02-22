<?php

namespace App\Http\Controllers\Api\Passwords;

use App\Http\Controllers\Controller;
use App\Models\Passwords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pass = Passwords::with('user')->where("user_id", Auth::user()->id)->get();
        
        return view("passwords.index", compact('pass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $longitud = 16;
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';
        $longitudCaracteres = strlen($caracteres);
        $contraseña = '';
        for ($i = 0; $i < $longitud; $i++) {
            $contraseña .= $caracteres[random_int(0, $longitudCaracteres - 1)];
        }

       return view('passwords.create', compact('contraseña'));
        
        //return response()->json($contraseña);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->session()->token();
        $passNew = [
            "title_site" => $request->title_site,
            "site_url" => $request->site_url,
            "gen_password" => $request->gen_password,
            "user_id" => Auth::user()->id
        ];
        

        $pass = Passwords::create($passNew);
        return redirect()->route("passwords.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Passwords $passwords)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Passwords $passwords)
    {
        return view('passwords.edit', compact('passwords'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Passwords $passwords)
    {
        $passwords->update($request->all());
        return redirect()->route('passwords.show', $passwords);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passwords $passwords)
    {
        $passwords->delete();
        return redirect()->route("passwords.index");
    }
}
