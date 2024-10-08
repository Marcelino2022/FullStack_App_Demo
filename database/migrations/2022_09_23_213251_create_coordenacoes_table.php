<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordenacoes', function (Blueprint $table) {
            $table->id();
            $table->string('Designacao_Coordenacao', 50);
            $table->string('Endereco_Coordenacao', 100);
            $table->string('Endereco', 50);
            $table->string('Telefone', 10);
            $table->string('Telemovel', 10);
            $table->string('Email', 50);
            $table->unsignedBigInteger('localidade_id');
            $table->unsignedBigInteger('permissoes_id');
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
        Schema::dropIfExists('coordenacoes');
    }
};
