<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesosCognitivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procesos_cognitivos', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_paciente');
            $table->foreign('id_paciente')->references('id')->on('pacientes');
            $table->integer('orientacion');
            $table->integer('atencion_concentracion');
            $table->integer('memoria');
            $table->integer('funciones_ejecutivas');
            $table->integer('lenguaje');
            $table->integer('percepcion');
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
        Schema::dropIfExists('procesos_cognitivos_controlers');
    }
}
