<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tag;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;

class TagController extends Controller
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
        $tags = Tag::orderBy('id', 'DESC')->paginate();

        //dd($tags); //helper para ver que tiene una variable
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //metodo para mostrar formulario
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request) //metodo para salvar datos
    {
        //validacion de campos con request

        $tag = Tag::create($request->all()); //se aceptan datos definidos en el modelo 
                //Tag, en array fillable y se validan con objeto $request->all()
        
        return redirect()->route('tags.edit', $tag->id)
            ->with('info', "Etiqueta creada con éxito"); //para mostrar mensaje
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //ver detalle de 1 etiqueta
    {
        $tag = Tag::find($id);

        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //muestra vista para actualizar
    {
        $tag = Tag::find($id);

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $id) //atualiza datos de bd
    {
        //validacion de campos con request

        $tag = Tag::find($id);

        $tag->fill($request->all())->save();
        //retorno a formulario de edicion con session flash cargada con mensaje de exito
        return redirect()->route('tags.edit', $tag->id)
            ->with('info', "Etiqueta actualizada con éxito");        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) //elimina registro
    {
        //si es request ajax
        if ($request->ajax()) {
            $tag = Tag::find($id);
            $tag->delete();
            $tags_total = Tag::all()->count(); //total de tags
            return response()->json([
                'total'=>$tags_total,
                'message'=>$tag->name . ' fue eliminado correctamente'
            ]);
        } else { //eliminacion con reload de pagina
            $tag = Tag::find($id)->delete();
            //con el metodo with() se guarda en sesion FLASH el par ('info', 'string')
            //Por sesion flash se entiende que el parametro se desvincula de la sesion una vez 
            //se carga la pagina con el response.
            return back()->with('info', 'Eliminado correctamente'); //retorno al index
        }    
    }
}
