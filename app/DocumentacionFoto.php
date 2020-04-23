<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentacionFoto extends Model
{
    protected $table = "documentacionFotos";

    protected $fillable = ["foto", "cliente_id", "cara"];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
    }
}
