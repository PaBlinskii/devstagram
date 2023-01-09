<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    // Aunque no utilicemos User $user se tiene que poner porque en la ruta se encuentra
    public function store(Request $request, User $user, Post $post)
    {
        // dd('comentando');
        // Validar
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        // Almacenar el Resultado
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        // Imprimir un mensaje
        return back()->with('mensaje', 'Comentario Realizado Correctamente');

    }
}
