<?php

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

//** Web (rutas para clientes (quienes ven los articulos)) **//

//muestra listado de posts
Route::get('/blog', 'Web\PageController@blog')->name('blog'); //la ruta se va a llamar blog

//permite ver detalles de un post particular al presionar el link 'Leer mas' de la view
//posts.blade.php. Recibe parametro 'slug'
Route::get('/entrada/{slug}', 'Web\PageController@post')->name('post');

//ruta para filtrado por categorias (al presionar link de la categoria de un post en su detalle)
Route::get('/categoria/{slug}', 'Web\PageController@category')->name('category');
//ruta para filtrado por etiquetas (al presionar link de etiqueta de un post en su detalle )
Route::get('/etiqueta/{slug}', 'Web\PageController@tag')->name('tag');

//** Admin (rutas para la parte adminsitrativa) **/

