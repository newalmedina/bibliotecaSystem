<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Libro;
use App\Genero;
use App\Editorial;
use App\Prestamo_detalle;


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

        $librosMasVendidos = DB::select("SELECT  count(lib.id) as cantidad,lib.nombre  FROM prestamo_detalles det inner join libros lib on det.libro_id=lib.id group by lib.nombre order by count(*) desc limit 5");
        $prestamos = DB::select("SELECT Date_format(prest.fecha_inicial,'%Y-%m') as fechaMes, count(det.id) as cantidad FROM prestamos prest inner join prestamo_detalles det on prest.id=det.prestamo_id group by fechaMes");
        $ultimosLibros = Libro::orderBy("id", "desc")->take(7)->get();
        //return  var_dump($prestamos);
        return view("inicio", compact("clientes", "libros", "editoriales", "generos", "librosMasVendidos", "ultimosLibros", "prestamos"));
    }
}
