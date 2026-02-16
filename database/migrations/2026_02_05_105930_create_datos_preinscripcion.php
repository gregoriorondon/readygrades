<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students_temporal_data', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('nucleo_id');
            $table->foreign('nucleo_id')->references('id')->on('nucleos')->cascadeOnUpdate();
            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carreras')->cascadeOnUpdate();
            $table->string('primer_name');
            $table->string('segundo_name')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('nacionalidad');
            $table->bigInteger('cedula')->unique();
            $table->string('genero');
            $table->date('fecha_nacimiento');
            $table->string('nacimiento_city');
            $table->string('civil');
            $table->string('email');
            $table->string('telefono');
            $table->string('telefono2')->nullable();
            $table->string('direccion');
            $table->string('city');
            $table->string('consejo');
            $table->string('comuna');
            $table->string('discapacidad')->nullable();
            $table->string('disciplina')->nullable();
            $table->unsignedBigInteger('title_student_temporal_id');
            $table->foreign('title_student_temporal_id')->references('id')->on('title_student_temporal')->cascadeOnUpdate();
            $table->string('mencion');
            $table->string('institucion');
            $table->string('cityinstitucion');
            $table->date('fecha_grado');
            $table->integer('promedio');
            $table->unsignedBigInteger('students_socio_economico_id');
            $table->foreign('students_socio_economico_id')->references('id')->on('students_socio_economico')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_public_inscripcion');
        Schema::dropIfExists('title_student_temporal');
        Schema::dropIfExists('students_socio_economico');
        Schema::dropIfExists('students_temporal_data');
    }
};
