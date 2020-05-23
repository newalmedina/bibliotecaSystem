<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo_detalle extends Model
{
    protected $table = "prestamo_detalles";

    protected $fillable = [
        "fecha_devolucion", "estatus", "libro_id",
        "prestamo_id"
    ];

    public function prestamo()
    {
        return $this->belongsTo('App\Prestamo', 'prestamo_id', 'id');
    }

    public function libro()
    {
        return $this->belongsTo('App\Libro', 'libro_id', 'id');
    }
}
