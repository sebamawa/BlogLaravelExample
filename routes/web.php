<?php
//use App\Category; //para prueba de carga de categorias en sesion
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::redirect('/', 'blog');

Auth::routes();

//*************** Web (rutas para clientes (invitados)) ********************//

//muestra listado de posts
Route::get('/blog', 'Web\PageController@blog')->name('blog'); //la ruta se va a llamar blog

// * Prueba de redireccion a metodo de controller con previa carga de datos (categorias) en sesion
/*Route::get('/blog', function() {
    if (empty(session('categories'))) {
        session(['count' => $count,'categories' => Category::all()]);
    }  
    return redirect()->action('Web\PageController@blog');
});
//se necesita una ruta para el metodo del controller
Route::get('/bloglist', 'Web\PageController@blog');//->name('blog'); //la ruta se va a llamar blog
*/

//permite ver detalles de un post particular al presionar el link 'Leer mas' de la view
//posts.blade.php. Recibe parametro 'slug'
Route::get('/entrada/{slug}', 'Web\PageController@post')->name('post');

//ruta para filtrado por categorias (al presionar link de la categoria de un post en su detalle)
Route::get('/categoria/{slug}', 'Web\PageController@category')->name('category');
//ruta para filtrado por etiquetas (al presionar link de etiqueta de un post en su detalle )
Route::get('/etiqueta/{slug}', 'Web\PageController@tag')->name('tag');

//*************************** Admin (rutas para la parte adminsitrativa) ***************************/

//crds de tags, categorias y posts
Route::resource('tags', 'Admin\TagController');
Route::resource('categories', 'Admin\CategoryController');
Route::resource('posts', 'Admin\PostController');

