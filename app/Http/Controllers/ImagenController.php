<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {   // Guardamos la imagen
        $imagen = $request->file('file'); 
        // le asignamos un ID y su extension
        $nombreImagen = Str::uuid() . "." . $imagen->extension(); 
        // con Intervention obtenemos la imagen hacia el servidor y le asignamos un tamaño 1000x1000 para cuadro
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);
        // Tomamos el path de la carpeta y asignamos el nombre de imagen
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);
        // Guardamos la ruta de la imagen

        return response()->json(['imagen' => $nombreImagen ]);
    }
}
