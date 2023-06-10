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
        Schema::table('membros', function (Blueprint $table) {
            $table->string('mobilizador_id')->nullable()->default(null)->change();
            $table->string('funcao_id')->nullable()->default(null)->change();
            $table->string('categoria_id')->nullable()->default(null)->change();
            $table->string('Imagem_Membro')->nullable()->default(null)->change();
            $table->string('Sigla_Tipo_Documento')->nullable()->default(null)->change();
            $table->string('Tipo_Documento')->nullable()->default(null)->change();
            $table->string('Data_Nascimento')->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Membros', function (Blueprint $table) {
            $table->string('mobilizador_id')->nullable()->default(null)->change();
            $table->string('funcao_id')->nullable()->default(null)->change();
            $table->string('categoria_id')->nullable()->default(null)->change();
            $table->string('Imagem_Membro')->nullable()->default(null)->change();
            $table->string('Sigla_Tipo_Documento')->nullable()->default(null)->change();
            $table->string('Tipo_Documento')->nullable()->default(null)->change();
            $table->string('Data_Nascimento')->nullable()->default(null)->change();
        });
    }
};
