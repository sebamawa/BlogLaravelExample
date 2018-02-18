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

    public function posts() {
        //una categoria puede tener (n) muchos posts
        return $this->hasMany(Post::class);
    }

}
