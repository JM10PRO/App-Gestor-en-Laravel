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
            $table->string('nif', 10)->nullable();
            $table->string('personacontacto', 30)->nullable();
            $table->integer('telefono')->nullable();
            $table->string('correo', 50)->nullable();
            $table->string('poblacion', 70)->nullable();
            $table->string('codpostal', 7)->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('estado', 5)->nullable();
            $table->string('fechacreacion', 10)->nullable();
            $table->string('operario', 50)->nullable();
            $table->string('fecharealizacion', 10)->nullable();
            $table->string('anotacionanterior', 140)->nullable();
            $table->string('anotacionposterior', 140)->nullable();
            $table->string('descripcion', 250)->nullable();
            $table->string('ficheroresumen', 20)->nullable();
            $table->string('fotos', 20)->nullable();
            $table->integer('cliente_id')->nullable()->index('fk_tareas_clientes');
            $table->unsignedBigInteger('user_id')->nullable()->index('fk_tareas_users1');
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
        Schema::dropIfExists('tareas');
    }
}
