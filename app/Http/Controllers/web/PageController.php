<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;

class PageController extends Controller
{
    public $categories;  //= Category::get();

    public function __construct() {
        //se hace la consulta para obtener la categorias cada vez que se llama a un
        //metodo de este controlador. Optimizacion: guardar categorias en sesion (ver web.php)
        $this->categories = Category::all();
    }

    //pasa a la view listado de posts
    public function blog() {
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);

        //$categories = Category::get();
        //$categories = session('categories');

        //return view('web.posts', compact('posts')); //uso helper view()
        return view('web.posts', ['posts' => $posts, 'categories'=>$this->categories]);
    }

    //permite ver detalles de un post particular segun el parametro slug
    public function post($slug) {
        //obtengo el post de la bd segun el slug
        $post = Post::where('slug', $slug)->first(); //uso first() pq refiere a un unico articulo
                                                    //first() devuelve el registro completo

        return  view('web.post', compact('post'));
    }

    //filtra los posts por categoria
    public function category($slug) {
        //consulta 1-N
        $category = Category::where('slug', $slug)->first();//pluck('id')->first(); //pluck() devuelve solo un campo (el id) del registro
        $categoryId = $category->id;
        $posts = Post::where('category_id', $categoryId)
            ->where('status', 'PUBLISHED')
            ->orderBy('id', 'DESC') //se puede intercambiar el orden de where y orderBy
            ->paginate(3);

            //parmetros a la view: coleccion de posts filtrados por categoria y categoria de filtro
            return  view('web.posts', ['posts'=>$posts, 'category'=>$category, 'categories'=>$this->categories]);    
    }

    //filtra los posts por tag seleccionada en la vista de detalle
    public function tag($slug) {
        //consulta N-N
        $tag = Tag::where('slug', $slug)->first();
        //busco posts que tienen etiquetas siempre y cuando estas etiquetas tengan el slug parametro
        $posts = Post::whereHas('tags', function($query) use($slug){
            $query->where('slug', $slug);
        })
        ->where('status', 'PUBLISHED')
        ->orderBy('id', 'DESC') //se puede intercambiar el orden de where y orderBy
        ->paginate(3);

        return  view('web.posts', ['posts'=>$posts, 'tag'=>$tag, 'categories'=>$this->categories]);//compact('posts'));    
    }  
    
    public function prueba() {
        return 'metodo prueba()';
    }
}
