<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJuridicanaturalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juridicanaturals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dependencia');
            $table->bigInteger('juridica_id')->unsigned();
            $table->foreign('juridica_id')->references('id')->on('clientes_juridicos')->onDelete('cascade');
            $table->bigInteger('natural_id')->unsigned();
            $table->foreign('natural_id')->references('id')->on('clientes_naturales')->onDelete('cascade');
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
        Schema::dropIfExists('juridicanaturals');
    }
}
