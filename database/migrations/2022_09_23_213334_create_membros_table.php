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
        Schema::create('membros', function (Blueprint $table) {
            $table->id();
            $table->string('Nome_Membro',50);
            $table->date('Data_Nascimento');
            $table->string('Numero_Documento', 14);
            $table->string('Tipo_Documento',30);
            $table->string('Sigla_Tipo_Documento', 5);
            $table->string('Imagem_Membro', 100);
            $table->string('Telemovel_Membro',12);
            $table->string('Email_Membro', 30);
            $table->unsignedBigInteger('ID_Mobilizador');
            $table->unsignedBigInteger('ID_Responsavel');
            $table->unsignedBigInteger('coordenacao_id');
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
        Schema::dropIfExists('membros');
    }
};
