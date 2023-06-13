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
        Schema::table('permissoes', function (Blueprint $table) {
            $table->date('Sigla_Permissao', 10)->after('Designacao_Permissao')->nullable(true)->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissoes', function (Blueprint $table) {
            $table->dropColumn('Sigla_Permissao');
        });
    }
};
