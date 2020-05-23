<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Autor;
use App\Genero;
use App\Editorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LibroController extends Controller
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
        return view("libro.index", compact("libros"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generos = Genero::all();
        $autores = Autor::all();
        $editoriales = Editorial::all();

        return view("libro.add", compact("autores", "generos", "editoriales"));
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
            "nombre" => "required|max:100|min:3",
            "sinopsis" => "required|max:255",
            "isbn" => "required|size:13|unique:libros,isbn",
            "fecha_publicacion" => "required|max:50|date",
            "estatus" => "required",
            "portada" => "image",
            "autor_id" => "required|exists:autores,id",
            "editorial_id" => "required|exists:editoriales,id",
            "genero_id" => "required|exists:generos,id",
            "stock" => "required"
        ]);

        $stock = $request["stock"];

        Libro::create($request->all());
        //guardando foto
        if ($request->hasFile('portada')) {
            $foto = $request->file('portada');
            $nombre = $foto->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;
            $foto->move("libroImagenes", $nombre);
            $ultimo_id = Libro::all()->last();
            Libro::where('id', $ultimo_id->id)
                ->update(['portada' => "libroImagenes/" . $nombre]);
        }

        return redirect()->route("libro.index")->with("success", "Guardado")
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
        $libro = Libro::find($id);
        return view("libro.show", compact("libro"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $libro = Libro::find($id);

        $generos = Genero::where('id', '!=', $libro->genero_id)->get();
        $autores = Autor::where('id', '!=', $libro->autor_id)->get();
        $editoriales = Editorial::where('id', '!=', $libro->editorial_id)->get();


        return view("libro.edit", compact("libro", "generos", "autores", "editoriales"));
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
            "nombre" => "required|max:10|min:3",
            "sinopsis" => "required|max:255",
            "isbn" => "required|size:13",
            "fecha_publicacion" => "required|max:50|date",
            "estatus" => "required",
            "portada" => "image",
            "autor_id" => "required|exists:autores,id",
            "editorial_id" => "required|exists:editoriales,id",
            "genero_id" => "required|exists:generos,id"
        ]);

        $libro = Libro::find($id);

        Libro::find($id)->update($request->all());

        //guardando foto

        if ($request->hasFile('portada')) {
            $foto = $request->file('portada');

            if ($libro->portada != "") {
                unlink($libro->portada);
            }

            $nombre = $foto->getClientOriginalName();
            $nombre = round(microtime(true)) . $nombre;
            $foto->move("libroImagenes", $nombre);
            Libro::find($id)->update(['portada' => "libroImagenes/" . $nombre]);
        } else {
            Libro::find($id)->update(['portada' => $libro->portada]);
        }
        return redirect()->route("libro.index")->with("success", "Actualizado")
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

        $libro = Libro::find($id);
        Libro::find($id)->delete();
        if ($libro->portada != "") {
            unlink($libro->portada);
        }

        return response()->json(['success' => 'Borrado']);
    }
}
