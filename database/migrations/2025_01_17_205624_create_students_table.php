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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique();
            $table->string('primer-name');
            $table->string('segundo-name');
            $table->string('primer-apellido');
            $table->string('segundo-apellido');
            $table->string('genero');
            $table->string('nacionalidad');
            $table->string('telefono');
            $table->date('fecha-nacimiento');
            $table->string('email');
            $table->string('direccion');
            $table->string('city');
            $table->string('carrera');
            $table->string('trayecto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
