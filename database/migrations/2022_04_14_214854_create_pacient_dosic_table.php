<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientDosicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacient_dosic', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('paciente_id');
            $table->unsignedInteger('dosi_id');
            $table->string('fabricante');
            $table->date('fecha_vacunacion');
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
        Schema::dropIfExists('pacient_dosic');
    }
}
