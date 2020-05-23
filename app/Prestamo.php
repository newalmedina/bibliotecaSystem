<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = "prestamos";

    protected $fillable = [
        "codigo", "fecha_inicial", "fecha_final", "estatus", "cliente_id",
        "usuario_id",
    ];
    public function prestamo_detalles()
    {
        return $this->hasMany('App\Prestamo_detalle', 'prestamo_id', 'id');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
    }
    public function usuario()
    {
        return $this->belongsTo('App\Usuario', 'usuario_id', 'id');
    }
}
