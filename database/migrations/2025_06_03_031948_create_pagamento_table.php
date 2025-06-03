<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pagamento', function (Blueprint $table) {
            $table->increments('id_pagamento');
            $table->unsignedInteger('id_comanda')->nullable();
            $table->date('data_pagamento');
            $table->string('forma_pagamento', 20);
            $table->timestamps();
            
            $table->foreign('id_comanda')->references('id_comanda')->on('comanda');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagamento');
    }
};
