<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUbigeoToPacients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacients', function (Blueprint $table) {
            //$table->unsignedInteger('grupo_riesgo_id');
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('ubigeo');
            $table->string('departamento');
            $table->string('provincia');
            $table->string('distrito');
            $table->date('fecha_vacunacion');
            $table->unsignedInteger('edad_minsa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacients', function (Blueprint $table) {
            //
        });
    }
}
