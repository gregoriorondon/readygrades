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
        Schema::create('carreras', function (Blueprint $table) {
            $table->id();
            $table->string('carrera')->unique();
            $table->timestamps();
        });
        Schema::create('trayectos', function (Blueprint $table) {
            $table->id();
            $table->string('trayectos');
            $table->timestamps();
        });
        Schema::create('tramos', function (Blueprint $table) {
            $table->id();
            $table->string('tramos');
            $table->timestamps();
        });
        Schema::create('tramo_trayecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tramo_id');
            $table->foreign('tramo_id')->references('id')->on('tramos')->cascadeOnUpdate();
            $table->unsignedBigInteger('trayecto_id');
            $table->foreign('trayecto_id')->references('id')->on('trayectos')->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('students', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('cedula');
            $table->string('primer_name');
            $table->string('segundo_name')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('genero');
            $table->string('nacionalidad');
            $table->string('telefono')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('email')->nullable();
            $table->string('direccion');
            $table->string('city');
            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carreras')->cascadeOnUpdate();
            $table->unsignedBigInteger('tramo_id');
            $table->foreign('tramo_id')->references('id')->on('tramos')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carreras');
        Schema::dropIfExists('trayectos');
        Schema::dropIfExists('tramos');
        Schema::dropIfExists('tramo_trayecto');
        Schema::dropIfExists('students');
    }
};
