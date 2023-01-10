<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        // Con pluck solo me traigo campos que me interesan
        // dd(auth()->user()->followings->pluck('id')->toArray());
        
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        // dd($posts);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
