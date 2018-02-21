<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Tag;

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
        return view('admin.tags.crate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //metodo para salvar datos
    {
        $tag = Tag::create($request->all()); //se aceptan datos definidos en el modelo Tag, en array fillable
        
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
    public function update(Request $request, $id) //atualiza datos de bd
    {
        $tag = Tag::find($id);

        $tag->fill($request->all)->save();

        //retorno a formulario de edicion
        return redirect()->route('tags.edit', $tag->id)
            ->with('info', "Etiqueta actualizada con éxito");        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //elimina registro
    {
        $tag = Tag::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente: ' . $tag->name); //retorno al index
    }
}
