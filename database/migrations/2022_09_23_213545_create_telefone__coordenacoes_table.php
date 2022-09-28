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
        Schema::create('telefone__coordenacoes', function (Blueprint $table) {
            $table->id();
            $table->string('Telefone',15);
            $table->string('Tipo',6);
            $table->unsignedBigInteger('coordenacao_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefone__coordenacoes');
    }
};
