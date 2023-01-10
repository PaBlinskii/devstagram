<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListarPost extends Component
{
    // Usamos componentes para reducir el código repetitivo y ser mas ordenado
    // Se declara para que el componente pueda acceder a ella
    public $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($posts)
    {
        // Por aqui se le pasa la información al componente
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.listar-post');
    }
}
