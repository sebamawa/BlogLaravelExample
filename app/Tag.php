<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    //funciones de relaciones de entidades (tablas)
    //Las relaciones en Eloquent (ORM) son definidas como metodos en las clases de los modelos,
    //de esta forma los modelos quedan relacionados de igual forma que las tablas fisicas de la bd

    //1 etiqueta tiene muchos posts (relacion N-N)
    public function post() {
        return $this->belongsToMany(Post::class);
    }
}
