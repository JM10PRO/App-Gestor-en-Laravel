<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('dni');
            $table->string('nombre', 50);
            $table->string('correo', 50);
            $table->integer('telefono');
            $table->string('direccion', 50);
            $table->timestamp('fecha_alta')->default('current_timestamp()');
            $table->string('tipo', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
