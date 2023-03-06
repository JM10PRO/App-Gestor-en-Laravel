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
        if (!Schema::hasTable('cuotas')) {
            Schema::create('cuotas', function (Blueprint $table) {
                $table->integer('id');
                $table->string('concepto');
                $table->date('fecha_emision');
                $table->integer('importe');
                $table->string('pagado', 2);
                $table->date('fecha_pago');
                $table->string('notas');
                $table->integer('cliente_id')->index('fk_cuotas_clientes1_idx');
            });
        }
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
