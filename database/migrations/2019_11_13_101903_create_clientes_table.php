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

        Schema::create('Clientes_Naturales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identificacion', 16)->unique();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('telefono');
            $table->string('email', 80);
            $table->string('direccion', 100);
            $table->timestamps();
        });

        Schema::create('Clientes_Juridicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nit', 20)->unique();
            $table->string('empresa', 150);
            $table->string('direccion', 100);
            $table->string('email', 80);
            $table->string('telefono');
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
        Schema::dropIfExists('Clientes_Naturales');
        Schema::dropIfExists('Clientes_Juridicos');
    }
}
