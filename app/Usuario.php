<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $table = "users";

    protected $fillable = [
        "nombre", "apellidos", "identificacion",
        "telefono", "correo", "estatus", "fecha_nacimiento", "foto", "password",
        "privilegio_id", "sexo", "direccion",
    ];
    public function privilegio()
    {
        return $this->belongsTo('App\Privilegio', 'privilegio_id', 'id');
    }
}
