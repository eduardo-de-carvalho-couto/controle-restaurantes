<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->increments('id_pedido');
            $table->unsignedInteger('id_comanda')->nullable();
            $table->unsignedInteger('cod_prod')->nullable();
            $table->tinyInteger('quantidade')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('id_comanda')->references('id_comanda')->on('comanda');
            $table->foreign('cod_prod')->references('cod_prod')->on('produto');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedido');
    }
};
