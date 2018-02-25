<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{

    public function __construct() {
        //seguridad para TODOS los metodos (solo se permite acceso a usuario logeuado)
        $this->middleware('auth'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //metodo para listar etiquetas
    {
        //$posts = Post::orderBy('id', 'DESC')->paginate(); //recupera todos los articulos
        $posts = Post::where('user_id', auth()->user()->id) //recupera los articulos del usuario logueado
            ->orderBy('id', 'DESC')
            ->paginate();
      
        //dd($posts); //helper para ver que tiene una variable
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //metodo para mostrar formulario
    {
        //recupero nombre y id de categorias para seleccionar desde form de crear 
        //articulo mediante un tag select
        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id'); //pluck es un 'select' 

        //recuepro tags para mostrarlos para selecccionar en checkboxes en el form de articulo    
        $tags = Tag::orderBy('name', 'ASC')->get();    

        return view('admin.posts.create', compact('categories', 'tags')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request) //metodo para salvar datos
    {
        //validacion de campos con request

        $post = Post::create($request->all()); //se aceptan datos definidos en el modelo 
                //Post, en array fillable y se validan con objeto $request->all()
        
        return redirect()->route('posts.edit', $post->id)
            ->with('info', "Entrada creada con éxito"); //para mostrar mensaje
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //ver detalle de 1 etiqueta
    {
        $post = Post::find($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //muestra vista para actualizar
    {
        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id'); //pluck es un 'select' 

        $tags = Tag::orderBy('name', 'ASC')->get(); 

        $post = Post::find($id);

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id) //atualiza datos de bd
    {
        //validacion de campos con request

        $post = Post::find($id);

        $post->fill($request->all())->save();
        //retorno a formulario de edicion con session flash cargada con mensaje de exito
        return redirect()->route('posts.edit', $post->id)
            ->with('info', "Entrada actualizada con éxito");        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) //elimina registro
    {
        $post = Post::find($id)->delete();
        //con el metodo with() se guarda en sesion FLASH el par ('info', 'string')
        //Por sesion flash se entiende que el parametro se desvincula de la sesion una vez 
        //se carga la pagina con el response.
        return back()->with('info', 'Eliminado correctamente'); //retorno al index      
    }
}
