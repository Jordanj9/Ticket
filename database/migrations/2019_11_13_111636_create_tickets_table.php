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
            $table->string('estado', 20)->default('PENDIENTE');
            $table->string('observacion')->nullable();
            $table->bigInteger('empleado_id')->unsigned()->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onDelete('cascade');
            $table->bigInteger('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente')->references('id')->on('clientes')->onDelete('cascade');
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
