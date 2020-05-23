<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Libro;
use App\Genero;
use App\Editorial;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::all();
        $clientes = Cliente::all();
        $editoriales = Editorial::all();
        $generos = Genero::all();
        return view("inicio", compact("clientes", "libros", "editoriales", "generos"));
    }
}
