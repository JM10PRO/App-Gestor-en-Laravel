<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvinciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provincias', function (Blueprint $table) {
            $table->char('cod', 2)->default('00')->primary()->comment("Código de la provincia de dos digitos");
            $table->string('nombre', 50)->default('')->index('nombre')->comment("Nombre de la provincia");
            $table->tinyInteger('comunidad_id')->index('FK_ComunidadAutonomaProv')->comment("Código de la comunidad a la que pertenece");
            $table->tinyInteger('comunidadautonoma_id')->index('fk_provincias_comunidadesautonomas1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provincias');
    }
}
