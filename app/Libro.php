<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        "nombre", "sinopsis", "isbn", "fecha_publicacion", "estatus",
        "portada", "autor_id", "editorial_id", "genero_id"
    ];
    public function genero()
    {
        return $this->belongsTo('App\Genero', 'genero_id', 'id');
    }
    public function autor()
    {
        return $this->belongsTo('App\Autor', 'autor_id', 'id');
    }
    public function editorial()
    {
        return $this->belongsTo('App\Editorial', 'editorial_id', 'id');
    }
}
