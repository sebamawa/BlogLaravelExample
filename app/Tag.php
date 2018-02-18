<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    //funciones de relaciones de entidades (tablas)    

    //1 etiqueta tiene muchos posts (relacion N-N)
    public function post() {
        return $this->belongsToMany(Post::class);
    }
}
