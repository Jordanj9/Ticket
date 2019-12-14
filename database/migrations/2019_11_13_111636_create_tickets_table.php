<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('radicado', 20);
            $table->string('descripcion');
            $table->enum('estado', ['PENDIENTE','ASIGNADO','APLAZADO','FINALIZADO'])->default('PENDIENTE');
            $table->string('observacion')->nullable();
            $table->string('dependencia')->nullable();
            $table->bigInteger('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->bigInteger('natural_id')->unsigned()->nullable();
            $table->foreign('natural_id')->references('id')->on('Clientes_Naturales')->onDelete('cascade');
            $table->bigInteger('juridica_id')->unsigned()->nullable();
            $table->foreign('juridica_id')->references('id')->on('Clientes_Juridicos')->onDelete('cascade');
            $table->enum('solicitante',['JURIDICA','NATURAL']);
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
        Schema::dropIfExists('tickets');
    }
}
