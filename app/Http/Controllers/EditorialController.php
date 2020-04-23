<?php

namespace App\Http\Controllers;

use App\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editoriales = Editorial::all();
        return view("editorial.index", compact("editoriales"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("editorial.add");
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
            "nombre" => "required|max:100|min:5|unique:editoriales,nombre"
        ]);

        Editorial::create($request->all());
        return redirect()->route("editorial.index")->with("success", "Guardado")
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
        $editorial = Editorial::find($id);
        return view("editorial.show", compact("editorial"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editorial = Editorial::find($id);
        return view("editorial.edit", compact("editorial"));
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
        Editorial::find($id)->update($request->all());
        return redirect()->route("editorial.index")->with("success", "Guardado")
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

        $editorial = Editorial::find($id);
        Editorial::find($id)->delete();
        return response()->json(['success' => 'Borrado']);
    }
}
