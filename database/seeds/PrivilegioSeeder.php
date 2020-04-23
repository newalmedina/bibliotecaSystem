<?php

use Illuminate\Database\Seeder;
use App\Privilegio;
use Illuminate\Support\Facades\DB;

class PrivilegioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //DB::table('privilegios')->truncate();
        Privilegio::truncate();
        Privilegio::create([
            "descripcion" => "Admin"
        ]);
        Privilegio::create([
            "descripcion" => "Bibliotecario"
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
