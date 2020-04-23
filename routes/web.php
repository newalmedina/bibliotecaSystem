<?php

use Illuminate\Support\Facades\Route;

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
//RUTAS LOGIN
Route::get('/', "LoginController@showLoginForm")->name("loginForm");
Route::post('login', 'LoginController@login')->name("login");
Route::post('logout', 'LoginController@logout')->name("logout");


Route::get('/inicio', function () {
    return view('inicio');
})->name("inicio");


//RUTA CONFIGURACION
Route::resource('configuration', 'ConfigurationController');

//RUTA USUARIO
Route::resource('usuario', 'UsuarioController');

//RUTA CLIENTE
Route::resource('cliente', 'ClienteController');

//RUTA AUTOR
Route::resource('autor', 'AutorController');

//RUTA EDITORIAL
Route::resource('editorial', 'EditorialController');

//RUTA GENERO
Route::resource('genero', 'GeneroController');

//RUTA LIBRO
Route::resource('libro', 'LibroController');
