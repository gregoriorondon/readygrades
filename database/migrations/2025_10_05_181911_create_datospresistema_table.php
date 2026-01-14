<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datospresistema', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('students_codigo_nucleo_id');
            $table->foreign('students_codigo_nucleo_id')->references('id')->on('students_codigo_nucleo')->cascadeOnUpdate();

            $table->unsignedInteger('definitiva');

            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias')->cascadeOnUpdate();

            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carreras')->cascadeOnUpdate();

            $table->unsignedbiginteger('seccion_id');
            $table->foreign('seccion_id')->references('id')->on('secciones')->cascadeonupdate();

            $table->string('periodo_name');

            $table->date('fecha_periodo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datospresistema');
    }
};
