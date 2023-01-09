<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user)
    {
        // Le quitamos el Request porque podemos almacenar el user autenticado directamente en attach
        // Es recomendable usar attach() cuando hay relación de muchos a muchos (tabla pivote), es decir cuando relacionas la misma tabla hay que usar attach
        $user->followers()->attach( auth()->user()->id);

        // Esto va leer el usuario que esta visitando su muro y le va agregar que lo esta siguiendo y va ser si esta autenticada

        return back();
    }

    public function destroy(User $user)
    {
        // Esto va hacer que la persona deje de seguir a otro usuario
        $user->followers()->detach( auth()->user()->id );
        return back();

    }

}
