<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('marca',50);
            $table->string('modelo',200)->nullable();
            $table->string('procesador');
            $table->string('memoria_ram');
            $table->string('disco_duro');
            $table->string('pantalla');
            $table->longText('licencias')->nullable();
            $table->year('anio_adquicision');
            $table->bigInteger('natural_id')->unsigned()->nullable();
            $table->foreign('natural_id')->references('id')->on('Clientes_Naturales')->onDelete('cascade');
            $table->bigInteger('juridica_id')->unsigned()->nullable();
            $table->foreign('juridica_id')->references('id')->on('Clientes_Juridicos')->onDelete('cascade');
            $table->string('propietario',8);
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
        Schema::dropIfExists('equipos');
    }
}
