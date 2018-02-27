<?php

namespace App\Policies;

use App\User; //toda politica esta asociada a un usuario
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Retorna true si el id del usuario coincide con el user_id del post, o sea 
     * si el post es del usuario
     */
    public function pass(User $user, Post $post) {
        return $user->id == $post->user_id;
    }
}
