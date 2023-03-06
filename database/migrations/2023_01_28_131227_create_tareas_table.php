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
            $table->string('nif', 9)->nullable();
            $table->string('personacontacto', 30)->nullable();
            $table->integer('telefono')->nullable();
            $table->string('correo', 50)->nullable();
            $table->string('poblacion', 70)->nullable();
            $table->integer('codpostal')->nullable();
            $table->string('provincia', 50)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->string('estado', 5)->nullable();
            $table->dateTime('fechacreacion')->nullable();
            $table->string('operario', 30)->nullable();
            $table->dateTime('fecharealizacion')->nullable();
            $table->string('anotacionanterior', 140)->nullable();
            $table->string('anotacionposterior', 140)->nullable();
            $table->string('descripcion', 250)->nullable();
            $table->string('ficheroresumen')->nullable();
            $table->string('fotos')->nullable();
            $table->integer('cliente_id')->nullable()->index('fk_clientes_cliente_id');
            $table->unsignedBigInteger('user_id')->nullable()->index('fk_users_user_id');
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
