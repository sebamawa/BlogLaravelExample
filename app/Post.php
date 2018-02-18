<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //campos para form
    protected $fillable = [
        'user_id', 'category_id', 'name', 'slug', 'excerpt', 'body', 'status', 'file'
    ];

    //funciones de relaciones de entidades (tablas)

    //funcion ('de relacion') para definir en Laravel que un post tiene un usuario (un post esta asociado a un usuario)
    //observar que como solo tiene 1 usuario, va en singular 
    public function user() {
        return $this->belongsTo(User::class);
    }

    //funcion de relacion con 1 categoria
    public function category() {
        return $this->belongsTo(Category::class);
    }

    //funcion de relacion de 1 post con varias etiquetas (relacion N-N)
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
