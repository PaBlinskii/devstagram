<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class PostController extends Controller
{
    // Proteger las paginas con middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        // dd(auth()->user());
        // dd($user->username);

        return view('dashboard', [
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

}

