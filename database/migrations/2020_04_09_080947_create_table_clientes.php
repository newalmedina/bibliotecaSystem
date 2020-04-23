<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellidos', 100);
            $table->char('identificacion', 9)->unique();
            $table->char('telefono', 9);
            $table->string('correo', 100);
            $table->boolean('estatus')->default(1);
            $table->date('fecha_nacimiento');
            $table->char('sexo', 1)->nullable($value = true)->default("M");
            $table->text('direccion')->nullable($value = true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
