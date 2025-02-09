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
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('students_id')->constrained('students');
            $table->foreignId('carreras_id')->constrained('carreras');
            $table->foreignId('trimestres_id')->constrained('trimestres');
            $table->dateTime('fecha-inscripcion');
            $table->timestamps();
            $table->unique(['students_id, carreras_id', 'trimestres_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
