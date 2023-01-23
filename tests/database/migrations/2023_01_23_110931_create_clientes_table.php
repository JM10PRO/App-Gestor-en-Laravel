<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('cif', 15);
            $table->string('nombre', 50);
            $table->integer('telefono');
            $table->string('correo', 50);
            $table->string('cuenta_corriente', 100);
            $table->string('pais', 30);
            $table->string('moneda', 10);
            $table->integer('cuota_mensual');
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
