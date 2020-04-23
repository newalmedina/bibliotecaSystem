<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autor;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autor::all();
        return view("autor.index", compact("autores"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("autor.add");
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
            "nombre" => "required|max:100|min:5|unique:autores,nombre"
        ]);

        Autor::create($request->all());
        return redirect()->route("autor.index")->with("success", "Guardado")
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
        $autor = Autor::find($id);
        return view("autor.show", compact("autor"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $autor = Autor::find($id);
        return view("autor.edit", compact("autor"));
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
            "nombre" => "required|max:100|min:5"
        ]);
        Autor::find($id)->update($request->all());
        return redirect()->route("autor.index")->with("success", "Guardado")
            ->with("mensaje", "Registro guardado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$autor = Autor::find($id);
        Autor::find($id)->delete();
        return response()->json(['success' => 'Borrado']);
    }
}
