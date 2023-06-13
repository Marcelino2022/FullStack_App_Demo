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
        Schema::table('funcoes', function (Blueprint $table) {
            $table->string('Designacao_Funcao', 200)->change();
            $table->string('Sigla_Funcao', 12)->after('Designacao_Funcao')->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funcoes', function (Blueprint $table) {
            $table->dropColumn('Sigla_Funcao');
        });
    }
};
