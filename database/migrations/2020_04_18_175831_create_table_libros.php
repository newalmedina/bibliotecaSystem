<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLibros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('sinopsis', 255);
            $table->char('isbn', 13)->unique();
            $table->date('fecha_publicacion');
            $table->boolean('estatus')->default(1);
            $table->text('portada')->nullable($value = true);
            $table->integer('stock');
            $table->integer('alquilados')->nullable($value = true)->default(0);
            $table->bigInteger('autor_id')->unsigned();
            $table->foreign('autor_id')
                ->references('id')
                ->on('autores')
                ->onDelete('cascade');
            $table->bigInteger('editorial_id')->unsigned();
            $table->foreign('editorial_id')
                ->references('id')
                ->on('editoriales')
                ->onDelete('cascade');
            $table->bigInteger('genero_id')->unsigned();
            $table->foreign('genero_id')
                ->references('id')
                ->on('generos')
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
        Schema::dropIfExists('libros');
    }
}
