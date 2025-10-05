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
            $table->string('cedula');
            $table->string('codigo');
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
            $table->unsignedBigInteger('nucleo_id');
            $table->foreign('nucleo_id')->references('id')->on('nucleos')->cascadeOnUpdate();
            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carreras')->cascadeOnUpdate();
            $table->unsignedBigInteger('tramo_trayecto_id');
            $table->foreign('tramo_trayecto_id')->references('id')->on('tramo_trayecto')->cascadeOnUpdate();
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
