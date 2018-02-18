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

//muestra listado de posts
Route::get('/blog', 'Web\PageController@blog')->name('blog'); //la ruta se va a llamar blog

//permite ver detalles de un post particular al presionar el link 'Leer mas' de la view
//recibe parametro 'slug'
Route::get('/blog/{slug}', 'Web\PageController@post')->name('post');

