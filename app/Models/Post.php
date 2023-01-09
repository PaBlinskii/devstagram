<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {   // Creando la relación inversa, varios post tienen un usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios()
    {   
        // Un post va tener multiples comentarios
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        // Revisa la tabla si la columna user_id contiene el user de tal post
        return $this->likes->contains('user_id', $user->id);
    }
}
