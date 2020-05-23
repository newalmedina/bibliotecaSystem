<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePrestamoDetalles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo_detalles', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_devolucion')->nullable($value = true);
            $table->boolean('estatus')->default(0);
            $table->bigInteger('libro_id')->unsigned();
            $table->foreign('libro_id')
                ->references('id')
                ->on('libros')
                ->onDelete('cascade');
            $table->bigInteger('prestamo_id')->unsigned();
            $table->foreign('prestamo_id')
                ->references('id')
                ->on('prestamos')
                ->onDelete('cascade');
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
        Schema::dropIfExists('prestamo_detalles');
    }
}
