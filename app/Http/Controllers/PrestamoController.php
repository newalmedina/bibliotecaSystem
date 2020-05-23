<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Cliente;
use App\Configuration;
use App\Libro;
use App\Prestamo;
use App\Prestamo_detalle;
use App\Mail\SendMail;

class PrestamoController extends Controller
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
        $prestamos = Prestamo::orderBy('id', 'desc')->get();

        return view('transaccion.prestamo.index', compact("prestamos"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prestamo = Prestamo::find($id);
        return view("transaccion.prestamo.show", compact("prestamo"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $libros = Libro::where('estatus', '1')->get();
        $clientes = Cliente::where("estatus", "1")->get();
        $configuracion = Configuration::select('libros_maximos')
            ->orderBy("id", "desc")
            ->first();
        $librosPermitidos = $configuracion->libros_maximos;
        return view("transaccion.prestamo.add", compact("libros", "clientes", "librosPermitidos"));
        // return view('transaccion.prestamo.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "usuario_id" => "required",
            "cliente_id" => "required",
            "libro_id" => "required"

        ]);
        function generarCodigo($longitud)
        {
            $key = '';
            $pattern = '1234567890';
            $max = strlen($pattern) - 1;
            for ($i = 0; $i < $longitud; $i++) $key .= $pattern{
                mt_rand(0, $max)};
            return $key;
        }

        $configuracion = Configuration::orderBy("id", "desc")
            ->first();
        do {
            $codigo = generarCodigo(8);
            $existe = Prestamo::where("codigo", $codigo)->get();
        } while (count($existe) > 0);

        $dias_maximo = $configuracion->num_dias_prestamos;
        $fecha_actual = date("Y-m-d");

        $fecha_final = strtotime($fecha_actual . "+ " . $dias_maximo . " days");
        $fecha_final = date("Y-m-d", $fecha_final);

        Prestamo::create([
            "codigo" => $codigo,
            "fecha_inicial" => $fecha_actual,
            "fecha_final" => $fecha_final,
            "cliente_id" => $request["cliente_id"],
            "usuario_id" => $request["usuario_id"]
        ]);

        //obteniendo ultimo prestamo
        $prestamo = Prestamo::all()->last();

        foreach ($request["libro_id"] as $libro_id) {

            Prestamo_detalle::create([
                "libro_id" => $libro_id,
                "prestamo_id" => $prestamo->id
            ]);
            $libro_alquilado = Libro::find($libro_id);
            $alquilado =   $libro_alquilado->alquilados + 1;

            Libro::find($libro_id)->update(['alquilados' => $alquilado]);
        }

        //$cliente = Cliente::find($request["cliente_id"]);

        //enviando correo electronico
        $data = [
            'tipo' => 'prestamo',
            'configuracion' => $configuracion,
            'usuario' => auth()->user()->nombre . " " . auth()->user()->apellidos,
            'cliente' =>  $prestamo->cliente,
            'subject' =>  "Alquiler de libros",
            'mensaje' =>  "Estamos muy agradecidos ya que en el dia de hoy usted ha realizado un prestamo con las siguientes Caracteristicas:",
            'prestamo' =>  $prestamo,
            'detalle' =>  $prestamo->prestamo_detalles

        ];

        Mail::to($data["cliente"]->correo)
            ->send(new SendMail($data));

        return redirect()->route("prestamo.index")->with("success", "Success")
            ->with("mensaje", "EL prestamo se ha efectuado correctamente");
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imprimir($id)
    {

        return "imprimir comprobante";
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id);
        $prestamo_detalles = Prestamo_detalle::where("prestamo_id", $id)->get();

        foreach ($prestamo_detalles as $detalle) {
            $libro_devuelto = Libro::find($detalle->libro_id);

            $devuelto =   $libro_devuelto->alquilados - 1;

            if ($devuelto < 0) {
                $devuelto = 0;
            }

            Libro::find($detalle->libro_id)->update(['alquilados' => $devuelto]);
        }

        Prestamo::find($id)->delete();

        return response()->json(['success' => 'Borrado']);
    }

    public function comprobarPrestamos($cliente_id)
    {
        $numlibros = DB::select('SELECT prest.id as total FROM prestamos prest inner join prestamo_detalles det on prest.id=det.prestamo_id where prest.cliente_id=? and prest.estatus=? and det.estatus=?', [$cliente_id, 0, 0]);
        return response()->json(['numeroLibros' => count($numlibros)]);
    }

    public function ajaxRequest($estatus)
    {
        switch ($estatus) {
            case "0":
                $prestamo = Prestamo::where("estatus", '0')
                    ->with('Cliente:id,nombre,apellidos,identificacion')
                    ->with(array('prestamo_detalles' => function ($query) { //aqui poongo el nombre de la relacin en el modelo padre
                        $query->select('id', 'prestamo_id', 'libro_id');
                    }))
                    ->orderBy('id', 'desc')
                    ->get();
                break;
            case "1":
                $prestamo = Prestamo::where("estatus", '1')
                    ->with('Cliente:id,nombre,apellidos,identificacion')
                    ->with(array('prestamo_detalles' => function ($query) { //aqui poongo el nombre de la relacin en el modelo padre
                        $query->select('id', 'prestamo_id', 'libro_id');
                    }))
                    ->orderBy('id', 'desc')
                    ->get();
                break;

            default:
                $prestamo = Prestamo::with('Cliente:id,nombre,apellidos,identificacion')
                    ->with(array('prestamo_detalles' => function ($query) { //aqui poongo el nombre de la relacin en el modelo padre
                        $query->select('id', 'prestamo_id', 'libro_id');
                    }))
                    ->orderBy('id', 'desc')
                    ->get();
        }
        // $numlibros = DB::select('SELECT prest.id as total FROM prestamos prest inner join prestamo_detalles det on prest.id=det.prestamo_id where prest.cliente_id=? and prest.estatus=? and det.estatus=?', [$cliente_id, 0, 0]);

        return response()->json(['prestamos' => $prestamo]);
    }
}
