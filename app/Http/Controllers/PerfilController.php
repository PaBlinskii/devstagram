<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        // Utilizamos el middleware para proteger la ruta
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            // Cuanto hay mas de 3 reglas Laravel recomienda usar Array
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
        ]);

        if($request->imagen) {
            // Guardar Cambios
            $imagen = $request->file('imagen'); 
            // le asignamos un ID y su extension
            $nombreImagen = Str::uuid() . "." . $imagen->extension(); 
            // con Intervention obtenemos la imagen hacia el servidor y le asignamos un tamaño 1000x1000 para cuadro
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
            // Tomamos el path de la carpeta y asignamos el nombre de imagen
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        // Guardar Cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        // Si no hay imagen, usar la de perfil ya puesta, sino poner nada
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        // Redireccionar
        return redirect()->route('posts.index', $usuario->username);

    }
}
