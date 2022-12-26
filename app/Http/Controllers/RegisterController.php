<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        // dd($request->get('username')); // Para ver por individual lo que mandamos
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:table:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required'
        ]);
    }
}
