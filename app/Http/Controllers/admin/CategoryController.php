<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
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
        $categories = Category::orderBy('id', 'DESC')->paginate();

        //dd($categories); //helper para ver que tiene una variable
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //metodo para mostrar formulario
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request) //metodo para salvar datos
    {
        //validacion de campos con request

        $category = Category::create($request->all()); //se aceptan datos definidos en el modelo 
                //Category, en array fillable y se validan con objeto $request->all()
        
        return redirect()->route('categories.edit', $category->id)
            ->with('info', "Categoría creada con éxito"); //para mostrar mensaje (se guada en sesion flash)
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //ver detalle de 1 etiqueta
    {
        $category = Category::find($id);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //muestra vista para actualizar
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id) //atualiza datos de bd
    {
        //validacion de campos con request

        $category = Category::find($id);

        $category->fill($request->all())->save();
        //retorno a formulario de edicion con session flash cargada con mensaje de exito
        return redirect()->route('categories.edit', $category->id)
            ->with('info', "Categoría actualizada con éxito");        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) //elimina registro
    {
        $category = Category::find($id)->delete();
        //con el metodo with() se guarda en sesion FLASH el par ('info', 'string')
        //Por sesion flash se entiende que el parametro se desvincula de la sesion una vez 
        //se carga la pagina con el response.
        return back()->with('info', 'Eliminado correctamente'); //retorno al index      
    }
}
