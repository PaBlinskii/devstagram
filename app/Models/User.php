<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {   // Creando la relación
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        // Un Usuario puede tener muchos likes en muchas publicaciones
        return $this->hasMany(Like::class);
    }

    // Almacena los seguidores de un usuario
    public function followers()
    {
        // Este metodo va insertar en la tabla followers tanto 'user_id' como 'follower_id'
        // Como nos salimos de las convenciones de laravel especificamos más
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    // Almacenando a los que seguimos
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    // Comprobar si el usuario ya sigue a otro
    public function siguiendo(User $user)
    {
        
        return $this->followers->contains( $user->id );
    }
}
