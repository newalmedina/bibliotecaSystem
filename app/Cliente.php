<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        "nombre", "apellidos", "identificacion",
        "telefono", "correo", "estatus", "fecha_nacimiento",
        "sexo", "direccion",
    ];

    public function documentacionFotos()
    {
        return $this->hasMany('App\DocumentacionFoto', 'cliente_id', 'id');
    }
}
