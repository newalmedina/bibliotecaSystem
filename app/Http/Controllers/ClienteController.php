<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\DocumentacionFoto;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
        $clientes = Cliente::all();
        return view("cliente.index", compact("clientes"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("cliente.add");
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
            "nombre" => "required|max:50|min:3",
            "apellidos" => "required|max:100|min:5",
            "identificacion" => "required|size:9|unique:clientes,identificacion",
            "telefono" => "required|size:9",
            "correo" => "required|email|max:100",
            "fecha_nacimiento" => "required|max:50|date",
            "estatus" => "required",
            "tipo_documentacion" => "required",
            "imagen" => "image|required",
            "imagen2" => "image",
        ]);

        Cliente::create([
            "nombre" => $request["nombre"],
            "apellidos" => $request["apellidos"],
            "identificacion" => $request["identificacion"],
            "telefono" => $request["telefono"],
            "correo" => $request["correo"],
            "estatus" => $request["estatus"],
            "fecha_nacimiento" => $request["fecha_nacimiento"],
            "sexo" => $request["sexo"],
            "direccion" => $request["direccion"],
        ]);

        $ultimo_id = Cliente::all()->last();

        //guardando foto passport
        if ($request["tipo_documentacion"] == "dni") {
            $imagen1 = $request->file('imagen');
            $nombre = $imagen1->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;

            DocumentacionFoto::create([
                "foto" => "clienteImagenes/" . $nombre,
                "cliente_id" => $ultimo_id->id,
            ]);
            $imagen1->move("clienteImagenes", $nombre);

            $imagen2 = $request->file('imagen2');
            $nombre = $imagen2->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;

            DocumentacionFoto::create([
                "foto" => "clienteImagenes/" . $nombre,
                "cliente_id" => $ultimo_id->id,
            ]);
            $imagen2->move("clienteImagenes", $nombre);
        } else {
            $imagen = $request->file('imagen');
            $nombre = $imagen->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;

            DocumentacionFoto::create([
                "foto" => "clienteImagenes/" . $nombre,
                "cliente_id" => $ultimo_id->id,
            ]);
            $imagen->move("clienteImagenes", $nombre);
        }

        return redirect()->route("cliente.index")->with("success", "Guardado")
            ->with("mensaje", "Registro guardado correctamente");
        return "success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view("cliente.show", compact("cliente"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view("cliente.edit", compact("cliente"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "nombre" => "required|max:50|min:3",
            "apellidos" => "required|max:100|min:5",
            "identificacion" => "required|size:9",
            "telefono" => "required|size:9",
            "correo" => "required|email|max:100",
            "fecha_nacimiento" => "required|max:50|date",
            "estatus" => "required",
            "tipo_documentacion" => "required",
            "imagen" => "image",
            "imagen2" => "image",
        ]);
        $cliente = Cliente::find($id);

        Cliente::find($id)->update(
            [
                "nombre" => $request["nombre"],
                "apellidos" => $request["apellidos"],
                "identificacion" => $request["identificacion"],
                "telefono" => $request["telefono"],
                "correo" => $request["correo"],
                "estatus" => $request["estatus"],
                "fecha_nacimiento" => $request["fecha_nacimiento"],
                "sexo" => $request["sexo"],
                "direccion" => $request["direccion"],
            ]
        );

        //guardando foto passport
        if ($request["tipo_documentacion"] == "dni" && $request->hasFile('imagen') && $request->hasFile('imagen2')) {
            //Eliminando imagenes anteriores
            if (count($cliente->documentacionFotos)) {
                $cantidadFOto = count($cliente->documentacionFotos);

                foreach ($cliente->documentacionFotos as $imagen) {
                    $foto = $imagen->foto;
                    unlink($imagen->foto);
                }
                DocumentacionFoto::where('cliente_id', $id)->delete();
            }

            //Insertando nueva imagenes
            $imagen1 = $request->file('imagen');
            $nombre = $imagen1->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;

            DocumentacionFoto::create([
                "foto" => "clienteImagenes/" . $nombre,
                "cliente_id" => $id,
            ]);

            $imagen1->move("clienteImagenes", $nombre);

            $imagen2 = $request->file('imagen2');
            $nombre = $imagen2->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;

            DocumentacionFoto::create([
                "foto" => "clienteImagenes/" . $nombre,
                "cliente_id" => $id,
            ]);
            $imagen2->move("clienteImagenes", $nombre);
        } else if ($request["tipo_documentacion"] == "pasaporte" && $request->hasFile('imagen')) {
            //Eliminando imagenes anteriores
            if (count($cliente->documentacionFotos)) {
                $cantidadFOto = count($cliente->documentacionFotos);

                foreach ($cliente->documentacionFotos as $imagen) {
                    $foto = $imagen->foto;
                    unlink($imagen->foto);
                }
                DocumentacionFoto::where('cliente_id', $id)->delete();
            }
            //Insertando nueva imagen
            $imagen = $request->file('imagen');
            $nombre = $imagen->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;

            DocumentacionFoto::create([
                "foto" => "clienteImagenes/" . $nombre,
                "cliente_id" => $id,
            ]);
            $imagen->move("clienteImagenes", $nombre);
        }
        return redirect()->route("cliente.index")->with("success", "Actualizado")
            ->with("mensaje", "Registro Actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (count($cliente->documentacionFotos)) {
            $cantidadFOto = count($cliente->documentacionFotos);

            foreach ($cliente->documentacionFotos as $imagen) {
                $foto = $imagen->foto;
                unlink($imagen->foto);
            }
        }

        Cliente::find($id)->delete();
        return response()->json(['success' => 'Borrado']);
    }
}
