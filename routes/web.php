<?php

use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\RegisteredAdminController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;

Route::controller(UniversityController::class)->group( function (){
    Route::get('/login-admin', 'admin');
    Route::get('/student', 'students');
    Route::post('/detalles-estudiante', 'studentspublicdetails');
    Route::post('/generarpdf', 'generarprocess')->name('generarpdf');
});

Route::controller(RegisteredAdminController::class)->middleware(['auth:admins,root', 'no-devolver', 'token'])->group( function(){
    // Carreras
    Route::get('/carreras', 'courses')->can('root');
    Route::get('/autocomplete', 'autocourses')->can('root');
    Route::post('/carreras-add-post', 'carreraprocess')->can('root');
    Route::get('/edit-courses/{carrera}', 'carreraedit')->can('root');
    Route::post('/savecarrera/{carrera}', 'cambiarcarrera')->can('root');
    // Nucleos
    Route::get('/autocomplete/nucleos', 'autonucleos')->can('root');
    Route::get('/nucleos', 'nucleo')->can('root');
    Route::get('/edit-nucleo/{nucleo}', 'nucleoedit')->can('root');
    Route::post('/save-nucleo/{nucleo}', 'editnucleosave')->can('root');
    Route::post('/crear-nucleo', 'nucleoadd')->can('root');
    // Tramos-Trayectos
    Route::get('/tramos-y-trayectos', 'trayectosview')->can('root');
    Route::post('/crear-trayecto-y-tramos', 'trayectosadd')->can('root');
    //
    Route::get('/nomina-profesores', 'profesornomina');
    Route::get('/registro-profesor', 'teacheradd');
    Route::post('/registro-profesor', 'teacherstore')->name('registro.profesor');
    Route::get('/docentes-panel-administrativo/{docentes}', 'teacherinfo');
    Route::get('/registro-administrador', 'adminadd');
    // Estudiantes
    Route::get('/estudiantes-panel-administrativo/{student}', 'studentsadmindetails');
    Route::post('/estudiantes-panel-administrativo', 'studentsadminsearch');
    Route::get('/estudiantes-calificacion/{student}', 'studentsadmincalification');
    Route::get('/estudiantes-panel-administrativo', 'studentsadmin');
    Route::get('/registro-estudiante', 'studentadd');
    Route::post('/registro-estudiante', 'studentstore');
    Route::get('/correccion/{nota}/estudiante/{estudiante}/{periodo}/{pensums}', 'correccion');
    Route::post('/save-correccion', 'savecorreccion');
    Route::get('/student-edit/{estudiante}', 'studentedit');
    Route::post('/guardar-edit-estudiante', 'savestudentedit');
    Route::get('/estudiantes-per', 'per');
    //Dashboard and Chart
    Route::get('/administracion', 'admindashboard');
    Route::get ('/datos-estudiantes', 'datadetails');
    //Descargar Excel
    Route::get('/download-student-list', 'exportStudentData');
    Route::get('/registro', 'create');
    Route::post('/registro', 'store');
    Route::get('/nomina-administradores', 'admininfo');
    Route::get('/administrador-panel-administrativo/{administrador}', 'admindetails');
    //Generar
    Route::get('/generar-documentos', 'generar');
    Route::post('/submit-student-cedula', 'busquedagenerar');
    Route::post('/submit-student-cedula-record', 'generarrecord');
    Route::post('/generar-pdf-record', 'generarrecordpdf');
    // Route::post('/generarpdf', 'generarprocess')->name('generarpdf');
    Route::get('/generarpdf', 'generarrecarga')->name('generarpdf');
    //Cargo
    Route::get('/agregar-cargo', 'cargoadd')->name('cargo.index')->can('root');
    Route::post('/agregar-create', 'cargosave')->name('crearcargo')->can('root');
    Route::get('/edit-cargo/{cargo}', 'cargoedit')->can('root');
    Route::post('/save-cargo/{cargo}', 'cargoeditsave')->name('savecargoedit')->can('root');
    // Título
    Route::get('/agregar-titulo', 'titulos')->can('root');
    Route::post('/crear-titulo', 'savetitulo')->can('root');
    Route::get('/editar-titulo/{titulo_id}', 'edittitulo')->can('root');
    Route::post('/save-edit-titulo', 'saveedittitulo')->can('root');
    //config
    //config
    Route::get('/config', 'config');
    Route::delete('/config/{id}', 'eliminarSesion')->name('auth.delete');
    Route::post('/config-save-basic', 'saveconfigbasic');
    //Materias
    Route::get('/materias', 'materias')->can('root');
    Route::get('/editar-materia/{materia}', 'materiaedit')->can('root');
    Route::post('/save-edit/{materia}', 'cambiaredit')->can('root');
    Route::post('/materia', 'materiasadd')->can('root');
    //Pensum
    Route::get('/pensum', 'pensum')->can('root');
    Route::get('/pensum-add', 'pensumadd')->can('root');
    Route::post('/pensums', 'pensumstore')->can('root');
    Route::get('/autocomplete/pensum', 'searchpensum')->can('root');
    // Seccion:
    Route::post('/seccionadd', 'seccionadd');
    // Periodos
    Route::get('/periodos', 'periodos');
    Route::post('/add-periodo', 'addperiodo');
    Route::post('/inactive-periodo', 'desasignarperiodo');
    // Asignar
    Route::get('/asignar', 'preasignar')->name('asignar');
    Route::get('/asignar-form', 'asignar')->name('asignar.buscar');
    Route::get('/asignar-profesor', 'asignardocentesave')->name('asignar.store');
    Route::post('/asignar-profesor-materia', 'asignardocentesavemateria')->name('save.asignacion');
    Route::delete('/asignar-profesor/{id}', 'desasignarprofesor')->name('asignar.desasignar');
    // cargar notas manualmente
    Route::get('/cargar-notas', 'cargarnotas');
    Route::post('/cargar-notas', 'cargarnotasstore');
    // titulos académicos de los estudiantes
    Route::get('/students-academic-tittle', 'tituloAcademicoUniversitario')->can('root');
    Route::post('/save-titulo-academic', 'tituloAcademicoSave')->can('root');
    Route::get('/editar-titulo-academico/{titulo_id}', 'editartituloacademico')->can('root');
    Route::post('/save-edit-titulo-academic', 'saveeditartituloacademico')->can('root');
});

Route::get('/login', [SesionController::class, 'create'])->name('login');
Route::post('/login', [SesionController::class, 'store']);
Route::post('/logout', [SesionController::class, 'destroy']);
Route::get('/login-profesor', [SesionController::class, 'createteacher'])->name('login-profesor');
// Route::post('/login', [SesionController::class, 'store']);

Route::controller(ProfesorController::class)->middleware(['auth:teachers'])->group( function(){
    Route::get('/dashboard', 'board');
    // Materias asignadas
    Route::get('/asignaciones', 'asignaciones');
    // Calificar estudiante
    Route::get('/calificacion/{asignacion}/estudiante/{estudiante}', 'calificaciones');
    Route::post('/guardar-calificacion', 'guardarcalificacion');
    Route::post('/editar-nota-pdf', 'solicitudedicion');
    // descargar calificaciones
    Route::post('/pdfcalificacion', 'descargarcalificacion');
    //config
    Route::get('/config-teacher', 'config');
    // Route::delete('/config/{id}', 'eliminarSesion')->name('auth.delete');
    // Route::post('/config-save-basic', 'saveconfigbasic');
});
