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
        Schema::table('coordenacoes', function (Blueprint $table) {
            $table->string('Bairro', 200)->after('endereco_coordenacao')->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coordenacoes', function (Blueprint $table) {
            $table->dropColumn('Bairro', 200);
        });
    }
};
