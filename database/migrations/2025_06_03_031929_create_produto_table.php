<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->increments('cod_prod');
            $table->string('nome_prod', 50);
            $table->decimal('valor_prod', 6, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produto');
    }
};
