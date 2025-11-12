<?php

namespace App\Exports;

use App\Models\Students;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsList implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Cedula',
            'Codigo',
            'Primer Nombre',
            'Segundo Nombre',
            'Primer Apellido',
            'Segundo Apellido',
            'Genero-Sexo',
            'Nacionalidad',
            'Fecha Nacimiento',
            'Nucleo',
            'Carrera',
        ];
    }

    public function collection()
    {
        $students = Students::with('nucleos')->get();

        return $students->map(function ($student) {
            return [
                'cedula' => $student->cedula,
                'codigo' => $student->codigo,
                'primer_name' => $student->primer_name,
                'segundo_name' => $student->segundo_name,
                'primer_apellido' => $student->primer_apellido,
                'segundo_apellido' => $student->segundo_apellido,
                'genero' => $student->genero,
                'nacionalidad' => $student->nacionalidad,
                'fecha_nacimiento' => $student->fecha_nacimiento,
                'nucleo' => $student->nucleos->nucleo,
                'carrera_id' => $student->carreras->carrera,
            ];
        });
    }
}
