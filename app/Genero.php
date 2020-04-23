<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $fillable = ["descripcion"];

    public function libros()
    {
        return $this->hasMany('App\Libro', 'genero_id', 'id');
    }
}
