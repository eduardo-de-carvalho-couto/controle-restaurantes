<?php

// add_soft_deletes_to_all_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Adicionar soft deletes para cada tabela
        Schema::table('mesa', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('produto', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('comanda', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pedido', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pagamento', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('caixa', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('mesa', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('produto', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('comanda', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('pedido', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('pagamento', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('caixa', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};