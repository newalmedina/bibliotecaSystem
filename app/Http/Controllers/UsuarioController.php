<?php

namespace App\Http\Controllers;

use App\Privilegio;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view("usuario.index", compact("usuarios"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $privilegios = privilegio::all();
        return view("usuario.add", compact("privilegios"));
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
            "identificacion" => "required|size:9|unique:usuarios,identificacion",
            "telefono" => "required|size:9",
            "correo" => "required|email|max:100|unique:usuarios,correo",
            "fecha_nacimiento" => "required|max:50|date",
            "password" => "required|max:18|min:6",
            "privilegio_id" => "required|exists:privilegios,id",
            "estatus" => "required",
            "foto" => "image",
        ]);

        $request['password'] = Hash::make($request['password']);
        $pass = $request['password'];
        Usuario::create($request->all());
        //guardando foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nombre = $foto->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;
            $foto->move("usuarioImagenes", $nombre);
            $ultimo_id = Usuario::all()->last();
            Usuario::where('id', $ultimo_id->id)
                ->update(['foto' => "usuarioImagenes/" . $nombre]);
        }

        return redirect()->route("usuario.index")->with("success", "Guardado")
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
        $usuario = Usuario::find($id);
        return view("usuario.show", compact("usuario"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $usuario = Usuario::find($id);
        //$privilegios =  privilegio::all();
        $privilegios = Privilegio::where('id', '!=', $usuario->privilegio_id)->get();

        return view("usuario.edit", compact("usuario", "privilegios", "privUsuario"));
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
            "privilegio_id" => "required|exists:privilegios,id",
            "estatus" => "required",
            "foto" => "image",
        ]);

        $usuario = Usuario::find($id);

        if ($request->input("password") == "") {
            $request["password"] = $usuario->password;
        } else {
            $request['password'] = Hash::make($request['password']);
        }

        Usuario::find($id)->update($request->all());

        //guardando foto

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            if ($usuario->foto != "") {
                unlink($usuario->foto);
            }

            $nombre = $foto->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;
            $foto->move("usuarioImagenes", $nombre);
            Usuario::find($id)->update(['foto' => "usuarioImagenes/" . $nombre]);
        } else {
            Usuario::find($id)->update(['foto' => $usuario->foto]);
        }
        return redirect()->route("usuario.index")->with("success", "Actualizado")
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

        $usuario = Usuario::find($id);
        Usuario::find($id)->delete();
        if ($usuario->foto != "") {
            unlink($usuario->foto);
        }

        return response()->json(['success' => 'Borrado']);
    }
}
