<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //campos para form
    protected $fillable = [
        'name', 'slug', 'body'
    ];

    //funciones de relaciones de entidades (tablas)

    //una categoria puede tener (n) muchos posts (relacion 1-N)
    public function posts() {
        return $this->hasMany(Post::class);
    }

}
