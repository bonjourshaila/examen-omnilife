<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',10);
            $table->string('nombre',50);
            $table->decimal('salarioDolares',10,2);
            $table->decimal('salarioPesos',10,2);
            $table->string('direccion', 30);
            $table->string('estado', 20);
            $table->string('ciudad', 20);
            $table->string('telefono', 10);
            $table->string('correo', 50);
            $table->tinyInteger('activo');
            $table->tinyInteger('eliminado');
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
        Schema::dropIfExists('empleado');
    }
}
