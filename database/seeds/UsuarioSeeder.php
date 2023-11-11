<?php

use Illuminate\Database\Seeder;
use App\Usuario;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Usuario::create([
            "nombre" => "Admin", "apellidos" => "Admin",
            "identificacion" => "000000000",
            "telefono" => "000000000",
            "correo" => "nmedina@gmail.com",
            "estatus" => 1,
            "fecha_nacimiento" => "2020-04-03 17:16:39",
            "password" =>  Hash::make("Secret15"),
            "privilegio_id" => 1

        ]);
    }
}
