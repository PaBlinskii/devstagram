<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // en Livewire no se pueden usar los Request $request
    // Primero hay que especificar que se va evaluar y despues livewire lo hace por ti
    public $post;
    public $isLiked; // esta variable es de tipo booleano
    public $likes; // Guarda el número de likes

    // Mount solo se ejecuta cuando es instanciado el componente
    public function mount($post)
    {
        $this->isLiked = $post->checkLike( auth()->user() );
        $this->likes = $post->likes->count();
    }

    // AQUI VA EL CODIGO REACTIVO
    // Modificamos la logica del LikeController acá añadiendole $this antes post
    // Traemos el código de likecontroller hacia acá y aplicamos los métodos
    public function like()
    {
        if( $this->post->checkLike(auth()->user() )){
            // Como tenemos acceso a la instancia de $post la aprovechamos
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
