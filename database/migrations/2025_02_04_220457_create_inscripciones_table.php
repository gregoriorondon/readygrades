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
        /* Schema::create('inscripciones', function (Blueprint $table) { */
        /*     /1* $table->id(); *1/ */
        /*     /1* $table->foreignId('students_id')->constrained('students'); *1/ */
        /*     /1* $table->foreignId('carreras_id')->constrained('carreras'); *1/ */
        /*     /1* $table->foreignId('trimestres_id')->constrained('trimestres'); *1/ */
        /*     /1* $table->dateTime('fecha-inscripcion'); *1/ */
        /*     /1* $table->timestamps(); *1/ */
        /*     /1* $table->unique(['students_id, carreras_id', 'trimestres_id']); *1/ */
        /* }); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
