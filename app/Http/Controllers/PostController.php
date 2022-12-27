<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // Proteger las paginas con middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // dd(auth()->user());
        return view('dashboard');
    }
}
