<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilegio extends Model
{
    protected $fillable = [
        'descripcion',
    ];

    public function usuarios()
    {
        return $this->hasMany('App\Usuario', 'privilegio_id', 'id');
    }
}
