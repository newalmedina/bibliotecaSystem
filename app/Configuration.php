<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['nombre_biblioteca', 'libros_maximos', 'num_dias_prestamos', 'direccion', 'foto', "telefono", "correo"];

}
