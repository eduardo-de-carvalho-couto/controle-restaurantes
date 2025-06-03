<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comanda', function (Blueprint $table) {
            $table->increments('id_comanda');
            $table->unsignedInteger('id_cliente')->nullable();
            $table->timestamp('data_comanda')->useCurrent();
            $table->timestamps();
            
            $table->foreign('id_cliente')->references('id_cliente')->on('mesa');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comanda');
    }
};
