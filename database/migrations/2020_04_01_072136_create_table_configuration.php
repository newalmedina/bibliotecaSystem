<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfiguration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();            
            $table->string('nombre_biblioteca', 100)->nulleable($value = false);
            $table->integer('libros_maximos');
            $table->integer('num_dias_prestamos');
            $table->string('telefono', 9);
            $table->string('correo', 100);
            $table->string('direccion', 255);
            $table->text('foto')->nullable($value = true);
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
        Schema::dropIfExists('configurations');
    }
}
