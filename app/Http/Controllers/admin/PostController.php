<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

use Illuminate\Support\Facades\Storage; //para almacenar imagenes en el server

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
        //recupero nombre e id de categorias para seleccionar desde form de crear 
        //articulo mediante un tag select
        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id'); //pluck recupera los campos especificos. Cuando tiene 2 parametros,
               //en este caso convierte a array con claves 'id' y valores 'name' los registros obtenidos     

        //recupero tags para mostrarlos para selecccionar en checkboxes en el form de articulo    
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
        //creo un post
        $post = Post::create($request->all()); //Asignacion en masa de atributos. Se aceptan datos definidos 
            //en el modelo Post, en array fillable y se validan con objeto $request->all(), para luego 
            //insertar el registro en la BD. Retorna una instancia del modelo

        //IMAGE manejo

        //si se envio imagen la almaceno en el server
        if ($request->file('file')) { 
            //ruta donde guardar la imagen
            //lado derecho de asignacion: almacena en el disco (en la carpeta public definida en filesystems.php)
            //en la carpeta image (se crea si no existe) la imagen que se envio desde el form.
            //Esto genero una ruta relativa (image/xxx.jpg)
            $path = Storage::disk('public')->put('image', $request->file('file'));

            //agrego la imagen a la instancia del modelo y actualizo registro en la bd
            //El helper asset crea la ruta completa (http://dominio/image/xxx.jpg),
            $post->fill(['file'=> asset($path)])->save();
        }   
        
        //ETIQUETAS
        //sync() se usa para sincronizar las relaciones (si se mandan 3 etiquetas, se crean 3 relaciones)
        //otros metodos relacionados con sync: attach y dettach
        //$post->tags()->sync($request->get('tags'));
        $post->tags()->attach($request->get('tags')); //attach() crea una nueva relacion
        
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
        //se usa politica de seguridad PostPolicy, en particular el metodo pass() de dicha clase
        //que verifica si el post pertenece al usaurio ( id(User) = usuario_id(Post) )
        $this->authorize('pass', $post);

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
        $post = Post::find($id);
        //se usa politica de seguridad PostPolicy, en particular el metodo pass() de dicha clase
        //que verifica si el post pertenece al usaurio ( id(User) = usuario_id(Post) )
        $this->authorize('pass', $post);

        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id'); 

        $tags = Tag::orderBy('name', 'ASC')->get(); 

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
        $this->authorize('pass', $post); //solo se pueden actualizar posts del usuario logueado

        $post->fill($request->all())->save();

        //IMAGE manejo
        if ($request->file('file')) { //si enviamos archivo desde el form
            //ruta donde guardar la imagen
            //lado derecho: almacena en el disco (en la carpeta public definida en filesystems.php)
            //en la carpeta image (se crea si no existe) la imagen que se envio desde el form.
            //Esto genero una ruta relativa (image/xxx.jpg)
            $path = Storage::disk('public')->put('image', $request->file('file'));
            //El helper asset crea la ruta completa (http://dominio/image/xxx.jpg)
            $post->fill(['file'=> asset($path)])->save();
        }   
        
        //ETIQUETAS
        //sync() se usa para sincronizar las relaciones (si se mandan 3 etiquetas, se crean 3 relaciones)
        //con sync() se combinan attach() y dettach()
        $post->tags()->sync($request->get('tags'));
        
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
        //$post = Post::find($id)->delete();
        $post = Post::find($id);
        $this->authorize('pass', $post); //solo permito eliminar post del usuario logueado (PostPolicy)
        $post->delete();

        //con el metodo with() se guarda en sesion FLASH el par ('info', 'string')
        //Por sesion flash se entiende que el parametro se desvincula de la sesion una vez 
        //se carga la pagina con el response.
        return back()->with('info', 'Eliminado correctamente'); //retorno al index      
    }
}
