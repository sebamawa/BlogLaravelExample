<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;

class PageController extends Controller
{
    //pasa a la view listado de posts
    public function blog() {
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);

        return view('web.posts', compact('posts')); //uso helper view()
    }

    //permite ver detalles de un post particular segun el parametro slug
    public function post($slug) {
        //obtengo el post de la bd segun el slug
        $post = Post::where('slug', $slug)->first();

        return  view('web.post', compact('post'));
    }
}
