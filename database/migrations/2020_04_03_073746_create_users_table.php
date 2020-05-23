<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('apellidos', 100);
            $table->char('identificacion', 9)->unique();
            $table->char('telefono', 9);
            $table->string('correo', 100)->unique();
            $table->boolean('estatus')->default(1);
            $table->date('fecha_nacimiento');
            $table->text('foto')->nullable($value = true);
            $table->text('password');
            $table->char('sexo', 1)->nullable($value = true)->default("M");
            $table->text('direccion')->nullable($value = true);

            $table->bigInteger('privilegio_id')->unsigned();
            $table->foreign('privilegio_id')
                ->references('id')
                ->on('privilegios')
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
        Schema::dropIfExists('users');
    }
}
