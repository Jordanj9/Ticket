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
            $table->bigIncrements('id');
            $table->enum('tipopersona', ['NATURAL', 'JURIDICA']);
            $table->string('identificacion', 16)->unique();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->integer('telefono');
            $table->string('email', 80);
            $table->string('direccion', 100);
            $table->string('nit', 20)->nullable();
            $table->string('empresa', 150)->nullable();
            $table->string('direccionemp', 100)->nullable();
            $table->string('dependencia', 80)->nullable();
            $table->string('emailempresa', 80)->nullable();
            $table->integer('telefonoemp')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
