<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

        // dd($request->remember);
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Con back() podemos regresar al link anterior donde llenamos el formulario
        if(!auth()->attempt($request->only('email', 'password'), $request->remember ) ) {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index');
    }
}
