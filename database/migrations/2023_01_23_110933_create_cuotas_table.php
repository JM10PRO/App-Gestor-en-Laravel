<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->integer('id');
            $table->string('concepto');
            $table->date('fecha_emision')->default('current_timestamp()');
            $table->integer('importe');
            $table->string('pagado', 2);
            $table->date('fecha_pago');
            $table->string('notas');
            $table->integer('cliente_id');
            
            $table->foreign('cliente_id', 'fk_cuotas_clientes1')->references('id')->on('clientes')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuotas');
    }
}
