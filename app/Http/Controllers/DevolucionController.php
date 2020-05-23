<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Libro;
use App\Prestamo;
use App\Prestamo_detalle;
use App\Configuration;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class DevolucionController extends Controller
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
        $prestamos = Prestamo::where("estatus", "0")
            ->orderBy('id', 'desc')->get();

        return view('transaccion.devolucion.index', compact("prestamos"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function devolverForm($id)
    {
        $prestamo = Prestamo::find($id);

        return view("transaccion.devolucion.devolver", compact("prestamo"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function devolver(Request $request, $prestamo_id)
    {
        $libro = $request->libros_id;
        $rules = [
            'libros_id' => 'required'
        ];

        $messages = [
            'libros_id.required' => 'Deves de seleccionar almenos 1 libro',

        ];
        $this->validate($request, $rules, $messages);
        $fechaActual = date('Y-m-d H:i:s');

        foreach ($request["libros_id"] as $libro_id) {
            //actualizando el prestamo detalle
            Prestamo_detalle::where("libro_id", $libro_id)
                ->where('prestamo_id', $prestamo_id)
                ->update([
                    'estatus' => 1,
                    'fecha_devolucion' => $fechaActual
                ]);

            //actualizando la tabla libros
            $libro_devuelto = Libro::find($libro_id);
            $devuelto =   $libro_devuelto->alquilados - 1;
            if ($devuelto < 0) {
                $devuelto = 0;
            }
            Libro::find($libro_id)->update(['alquilados' => $devuelto]);
        }

        //Actualizar prestame cabecera
        $estatus_prestamo = 1;

        $prestamo_detalles = Prestamo_detalle::where("prestamo_id", $prestamo_id)->get();

        foreach ($prestamo_detalles as $detalle) {
            if ($detalle->estatus == 0) {
                $estatus_prestamo = 0;
            }
        }

        //enviando correo electronico
        $configuracion = Configuration::orderBy("id", "desc")
            ->first();
        $prestamo = Prestamo::find($prestamo_id);

        $data = [
            'tipo' => "devolucion",
            'configuracion' => $configuracion,
            'usuario' => auth()->user()->nombre . " " . auth()->user()->apellidos,
            'cliente' =>  $prestamo->cliente,
            'subject' =>  "Devuelta de libros",
            'mensaje' =>  "Gracias por haber devuelto el libro, espero que lo hallas disfrutado:",
            'prestamo' =>  $prestamo,
            'detalle' =>  $prestamo->prestamo_detalles
        ];

        Mail::to($data["cliente"]->correo)
            ->send(new SendMail($data));

        if ($estatus_prestamo == 1) {
            Prestamo::find($prestamo_id)->update(['estatus' => $estatus_prestamo]);
            return redirect()->route("devolucion.index")->with("success", "Success")
                ->with("mensaje", "La devolucion se ha efectuado correctamente");
        }
        return redirect()->route("devolucion.devolver", $prestamo_id)->with("success", "Success")
            ->with("mensaje", "La devolucion se ha efectuado correctamente");
    }
}
