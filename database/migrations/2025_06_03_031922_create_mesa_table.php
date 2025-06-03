<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mesa', function (Blueprint $table) {
            $table->increments('id_cliente');
            $table->string('nome_cliente', 80)->nullable();
            $table->tinyInteger('numero_mesa')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mesa');
    }
};
