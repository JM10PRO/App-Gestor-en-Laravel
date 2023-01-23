<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('nif', 10);
            $table->string('personacontacto', 30);
            $table->integer('telefono');
            $table->string('correo', 50);
            $table->string('poblacion', 70);
            $table->string('codpostal', 7);
            $table->string('provincia', 50);
            $table->string('direccion', 100);
            $table->string('estado', 5);
            $table->string('fechacreacion', 10);
            $table->string('operario', 50);
            $table->string('fecharealizacion', 10);
            $table->string('anotacionanterior', 140);
            $table->string('anotacionposterior', 140);
            $table->string('descripcion', 250);
            $table->string('ficheroresumen', 20);
            $table->string('fotos', 20);
            $table->integer('cliente_id');
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('cliente_id', 'fk_tareas_clientes')->references('id')->on('clientes')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('user_id', 'fk_tareas_users1')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas');
    }
}
