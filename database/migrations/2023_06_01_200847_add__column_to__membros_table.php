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
            $table->string('Morada_Membro', 100)->after('Email_Membro')->nullable(true)->default(null);
            $table->date('Data_Alistamento', 100)->after('Email_Membro')->nullable(true)->default(null);
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
            $table->dropColumn('Morada_Membro', 100)->after('Email_Membro')->nullable(true)->default(null);
            $table->date('Data_Alistamento', 100)->after('Email_Membro')->nullable(true)->default(null);
        });
    }
};
