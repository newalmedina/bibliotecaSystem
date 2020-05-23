<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prestamo;
use App\Configuration;

class PdfController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $prestamo = Prestamo::find($id);
        $configuracion = Configuration::orderBy("id", "desc")
            ->first();
        $id_prestamo = $prestamo->codigo;
        $paper_size = array(0, 0, 260, 360);
        //$dompdf->set_paper($paper_size);
        $pdf = \PDF::loadView('pdf.index', compact('prestamo', 'configuracion'))->setPaper($paper_size);
        return $pdf->stream();
        //return $pdf->download('comprobante.pdf');
    }
}
