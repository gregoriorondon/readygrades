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
        Schema::create('nucleos', function (Blueprint $table) {
            $table->id();
            $table->string('nucleo')->unique();
            $table->timestamps();
        });
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('inicio');
            $table->date('fin');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
        Schema::create('tipos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->unique();
            $table->timestamps();
        });
        DB::table('tipos')->insert([
            ['tipo'=>'superadmin', 'created_at'=>now(), 'updated_at'=>now()],
            ['tipo'=>'administrador', 'created_at'=>now(), 'updated_at'=>now()],
            ['tipo'=>'profesor', 'created_at'=>now(), 'updated_at'=>now()]
            ]);
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('cargo')->unique();
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipos')->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('estudios', function (Blueprint $table) {
            $table->id();
            $table->string('estudio')->unique();
            $table->string('abrev')->unique();
            $table->timestamps();
        });
        Schema::create('secciones', function (Blueprint $table) {
            $table->id();
            $table->string('seccion')->unique();
            $table->timestamps();
        });
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('materia')->unique();
            $table->string('codigo')->unique();
            $table->string('unidadcurricular');
            $table->boolean('per')->default(true);
            $table->timestamps();
        });
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
        // Crear el Trayecto Inicial
        DB::table('trayectos')->insert([
            'trayectos'=>'Trayecto Inicial',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        $trayectoId = DB::getPdo()->lastInsertId();
        DB::table('tramos')->insert([
            'tramos'=>'Tramo Inicial',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);
        $tramoId = DB::getPdo()->lastInsertId();
        DB::table('tramo_trayecto')->insert([
            'tramo_id'=> $tramoId,
            'trayecto_id'=> $trayectoId,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        Schema::create('students', function (Blueprint $table) {
            $table->id()->unique();
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
            $table->unsignedbiginteger('periodo_id');
            $table->foreign('periodo_id')->references('id')->on('periodos')->cascadeonupdate();
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('primer-name');
            $table->string('segundo-name')->nullable();
            $table->string('primer-apellido');
            $table->string('segundo-apellido')->nullable();
            $table->string('genero');
            $table->string('nacionalidad');
            $table->string('cedula')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('estudio_id');
            $table->foreign('estudio_id')->references('id')->on('estudios')->cascadeOnUpdate();
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos')->cascadeOnUpdate();
            $table->unsignedBigInteger('nucleo_id');
            $table->foreign('nucleo_id')->references('id')->on('nucleos')->cascadeOnUpdate();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('profesores', function (Blueprint $table) {
            $table->id();
            $table->string('primer-name');
            $table->string('segundo-name')->nullable();
            $table->string('primer-apellido');
            $table->string('segundo-apellido')->nullable();
            $table->string('genero');
            $table->string('nacionalidad');
            $table->string('cedula')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('estudio_id');
            $table->foreign('estudio_id')->references('id')->on('estudios')->cascadeOnUpdate();
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos')->cascadeOnUpdate();
            $table->unsignedBigInteger('nucleo_id');
            $table->foreign('nucleo_id')->references('id')->on('nucleos')->cascadeOnUpdate();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('pensum', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')->references('id')->on('carreras')->cascadeOnUpdate();
            $table->unsignedBigInteger('tramo_trayecto_id');
            $table->foreign('tramo_trayecto_id')->references('id')->on('tramo_trayecto')->cascadeOnUpdate();
            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias')->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('nota_uno')->nullable();
            $table->string('nota_dos')->nullable();
            $table->string('nota_tres')->nullable();
            $table->string('nota_cuatro')->nullable();
            $table->string('nota_extra')->nullable();
            $table->string('nota_recuperacion')->nullable();
            $table->boolean('editado')->default(false);
            $table->string('nota_editar')->nullable();
            $table->unsignedBigInteger('pensum_id');
            $table->foreign('pensum_id')->references('id')->on('pensum')->cascadeOnUpdate();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnUpdate();
            $table->unsignedBigInteger('periodo_id');
            $table->foreign('periodo_id')->references('id')->on('periodos')->cascadeOnUpdate();
            $table->timestamps();
        });
        Schema::create('profesor_asignar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profesor_id');
            $table->foreign('profesor_id')->references('id')->on('profesores')->cascadeOnUpdate();
            $table->unsignedBigInteger('pensum_id');
            $table->foreign('pensum_id')->references('id')->on('pensum')->cascadeOnUpdate();
            $table->unsignedBigInteger('seccion_id');
            $table->foreign('seccion_id')->references('id')->on('secciones')->cascadeOnUpdate();
            // $table->unsignedBigInteger('periodo_id')
            // $table->foreign('periodo_id')->references('id')->on('periodos')->cascadeOnUpdate();
            $table->unique(['pensum_id', 'seccion_id', /*'periodo_id'*/], 'unique_sections');
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
        Schema::dropIfExists('nucleos');
        Schema::dropIfExists('tipos');
        Schema::dropIfExists('notas');
        Schema::dropIfExists('pensum');
        Schema::dropIfExists('materias');
        Schema::dropIfExists('secciones');
        Schema::dropIfExists('estudios');
        Schema::dropIfExists('cargos');
        Schema::dropIfExists('users');
        Schema::dropIfExists('profesores');
        Schema::dropIfExists('profesor_asignar');
        Schema::dropIfExists('periodos');
    }
};
