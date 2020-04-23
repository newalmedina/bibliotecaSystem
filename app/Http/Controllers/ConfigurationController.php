<?php

namespace App\Http\Controllers;

use App\Configuration;
use Exception;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuracion = Configuration::all();
        if ($configuracion->count()) {
            $configuracion = Configuration::orderBy("id", "desc")->first();
            return view("configuration.edit", compact("configuracion"));
        } else {
            return view("configuration.add");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "nombre_biblioteca" => "required|max:100|min:5",
            "libros_maximos" => "required|max:2",
            "num_dias_prestamos" => "required|max:2",
            "direccion" => "required|max:255|min:10'",
            "telefono" => "required|size:9",
            "correo" => "required|email|max:100",
            "foto" => "required|image",
        ]);

        Configuration::create($request->all());

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nombre = $foto->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;
            $foto->move("configuracionImagenes", $nombre);
            //CAMBIANDO NOMBRE DEL REQUEST NO ME FUNCIONO
            // $request->merge([ 'foto' => $nombre ]);
            $ultimo_id = Configuration::all()->last();
            Configuration::where('id', $ultimo_id->id)
                ->update(['foto' => "configuracionImagenes/" . $nombre]);
        }
        return redirect()->route("configuration.index")->with("success", "Guardado")
            ->with("mensaje", "Registro guardado correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            "nombre_biblioteca" => "required|max:100|min:5",
            "libros_maximos" => "required|max:2",
            "num_dias_prestamos" => "required|max:2",
            "direccion" => "required|max:255|min:10",
            "telefono" => "required|size:9",
            "correo" => "required|email|max:100'"
        ]);

        $configuracion = Configuration::find($id);
        Configuration::find($id)->update($request->all());

        //guardando foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            if ($configuracion->foto != "") {
                unlink($configuracion->foto);
            }

            $nombre = $foto->getClientOriginalName();
            $nombre =  round(microtime(true)) . $nombre;
            $foto->move("configuracionImagenes", $nombre);
            Configuration::find($id)->update(['foto' => "configuracionImagenes/" . $nombre]);
        } else {
            Configuration::find($id)->update(['foto' => $configuracion->foto]);
        }


        return redirect()->route("configuration.index")->with("success", "Actualizado")
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
        //
    }
}
