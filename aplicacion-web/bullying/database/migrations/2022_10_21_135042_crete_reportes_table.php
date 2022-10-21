<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreteReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_docente')->auto_increment;
            $table->unsignedBigInteger('id_estudiante');
            $table->unsignedBigInteger('id_tutor_legal');
            $table->string('descripcion');
            $table->string('fecha');
            $table->foreign('id_docente')->references('id')->on('docentes');
            $table->foreign('id_estudiante')->references('id')->on('estudiantes');
            $table->foreign('id_tutor_legal')->references('id')->on('tutores_legales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
