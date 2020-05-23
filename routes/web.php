<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Cliente;
use App\Prestamo_detalle;
use App\Prestamo;
use App\Libro;

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
Route::get('/', "LoginController@showLoginForm")->name("loginForm")->middleware("guest");

Route::post('login', 'LoginController@login')->name("login");
Route::post('logout', 'LoginController@logout')->name("logout");


Route::get('/inicio', "DashboardController@index")->name("inicio")->middleware("auth");


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


//RUTA PRESTAMO
Route::get('/prestamo', 'PrestamoController@index')->name("prestamo.index");
Route::get('/prestamo/create', 'PrestamoController@create')->name("prestamo.create");
Route::post('/prestamo/store', 'PrestamoController@store')->name("prestamo.store");
Route::delete('/prestamo/eliminar/{id}', 'PrestamoController@destroy')->name("prestamo.destroy");
Route::get('/prestamo/imprimir/{id}', 'PrestamoController@imprimir')->name("prestamo.imprimir");
Route::get('/prestamo/show/{id}', 'PrestamoController@show')->name("prestamo.show");
//pETICIONES AJAX
Route::get('/prestamo/comprobarPrestamos/{cliente_id}', 'PrestamoController@comprobarPrestamos')->name("prestamo.comprobarPrestamos");
Route::get('/prestamo/ajaxRequest/{estatus}', 'PrestamoController@ajaxRequest')->name("prestamo.ajaxRequest");

//RUTA DEVOLUCION
Route::get('/devolucion', 'DevolucionController@index')->name("devolucion.index");
Route::get('/devolucion/{id}', 'DevolucionController@devolverForm')->name("devolucion.devolverForm");
Route::post('/devolucion/{id}', 'DevolucionController@devolver')->name("devolucion.devolver");
//RUTA PDF
Route::get('/pdf/{id}', 'PdfController@index')->name("pdf");

//haciendo pruebas enviando email 

Route::get('/prueba', function () {
})->name("prueba");
