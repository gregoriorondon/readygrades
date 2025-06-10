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
        Schema::create('constancia_de_estudios', function (Blueprint $table) {
            $table->id();
            $table->string('entidad_superior');
            $table->string('ministerio');
            $table->string('nivel_educativo');
            $table->string('nombre_institucion');
            $table->string('sede_institucion');
            $table->string('departamento');
            $table->string('nucleo');
            $table->string('titulo_documento');
            $table->text('introduccion');
            $table->text('texto_pre_cedula');
            $table->text('texto_estatus_estudiante');
            $table->text('texto_inicio_fecha');
            $table->text('texto_dia');
            $table->text('texto_mes');
            $table->text('texto_anio');
            $table->text('nota_validez');
            $table->text('texto_emitido_por');
            $table->text('nota_validez_pie');
            $table->timestamps();
        });

        DB::table('constancia_de_estudios')->insert([
            [
                'entidad_superior' => 'República Bolivariana de Venezuela',
                'ministerio' => 'MPP Educación Universitaria, Ciencia Y Tecnología',
                'nivel_educativo' => 'Educación Universitaria',
                'nombre_institucion' => 'Universidad Politécnica Territorial',
                'sede_institucion' => 'Del Estado Trujillo',
                'departamento' => 'Área De Registro, Seguimiento Y Control De Estudios',
                'nucleo' => 'Núcleo',
                'titulo_documento' => 'Constancia De Estudios',
                'introduccion' => 'Quien suscribe, jefe del área de Admisión y Control de Estudios de la institución hace constar que el ( la ) ciudadano(a)',
                'texto_pre_cedula' => 'titular de la cédula de identidad',
                'texto_estatus_estudiante' => 'es alumno regular de esta casa de estudios del:',
                'texto_inicio_fecha' => 'Constancia que se expide en',
                'texto_dia' => 'a los',
                'texto_mes' => 'días del mes de',
                'texto_anio' => 'del',
                'nota_validez' => 'Esta constancia es valida por tres meses a partir de la fecha',
                'texto_emitido_por' => 'Emitido por:',
                'nota_validez_pie' => 'Valida por tres meses a partir de la fecha de emisión.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('constancia_de_estudios');
    }
};
