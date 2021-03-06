<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //funciones de relaciones de entidades (tablas)
    //Las relaciones en Eloquent (ORM) son definidas como metodos en las clases de los modelos,
    //de esta forma los modelos quedan relacionados de igual forma que las tablas fisicas de la bd

    //1 usuario tiene muchos posts (relacion 1-N)
    public function posts() {
        //un usuario puede tener (n) muchos posts
        return $this->hasMany(Post::class);
    }    
}
