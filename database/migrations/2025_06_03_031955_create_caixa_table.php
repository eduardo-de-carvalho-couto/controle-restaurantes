<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('caixa', function (Blueprint $table) {
            $table->increments('id_transacao');
            $table->string('tipo_transacao', 7);
            $table->decimal('valor_transacao', 10, 2);
            $table->unsignedInteger('id_pagamento')->nullable();
            $table->timestamp('data_transacao')->useCurrent();
            $table->timestamps();
            
            $table->foreign('id_pagamento')->references('id_pagamento')->on('pagamento');
        });
    }

    public function down()
    {
        Schema::dropIfExists('caixa');
    }
};
