<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // Solo usamos user_id porque post_id lo recibe automaticamente por la relacion hasMany()
    protected $fillable = [
        'user_id'
    ];
}
